<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\PendudukModel;
use App\Models\TempPendudukModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    protected UserContract $pendudukContract;

    public function __construct(UserContract $pendudukContract)
    {
        $this->pendudukContract = $pendudukContract;
    }

    public function indexAdmin()
    {
        $residents = UserModel::paginate(15);
        $page = 'data-dasawisma';
        $pageHeader = 'Data Dasawisma';
        return view('admin._dasawismaData.index', compact('residents', 'page', 'pageHeader'));
    }

    public function indexUser()
    {
        $userId = Auth::id();
        $resident = UserModel::findOrFail($userId);
        return view('user._dasawismaData.index', ['pages' => 'Data Anda', 'resident' => $resident]);
    }

    public function add()
    {
        return view('admin._dasawismaData.add');
    }


    public function storeUser(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->pendudukContract->storeUser($validated);
        return redirect()->route('admin.data-dasawisma.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }


    public function deleteUser(UserModel $penduduk): RedirectResponse
    {
        $this->pendudukContract->deleteUser($penduduk);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil di hapus.');
    }


    public function edit()
    {
        return view('user._residentData.index'); //PERLU DIBAHAS terkait tampilan data penduduk

    }


    public function validateEditRequest(Request $request, UserModel $penduduk): RedirectResponse
    {
        // Validasi apakah dokumen diterima atau ditolak
        $request->validate([
            'action' => 'required|in:accept,reject',
        ]);

        $tempPenduduk = TempPendudukModel::where('nik', $penduduk->nik)->first();
        // Jika pengajuan diterima
        if ($request->action === 'accept') {
            // Ubah data penduduk di tabel utama sesuai dengan data di tabel temporary
            $penduduk->update((array) $tempPenduduk);

            // Hapus data penduduk dari tabel temporary
            TempPendudukModel::where('nik', $penduduk->nik)->delete();

            return redirect()->route('penduduk.index')->with('success', 'Pengajuan edit data diterima.');
        }

        // Jika pengajuan ditolak, tidak dilakukan perubahan apapun
        if ($request->action === 'reject') {
            $tempPenduduk->status = 'Ditolak';
            $tempPenduduk->save();

            return redirect()->route('penduduk.index')->with('success', 'Pengajuan edit data ditolak.');
        }
    }


    public function requestEditForm(Request $request, UserModel $penduduk): RedirectResponse
    {
        // Periksa apakah ada entri dengan id_penduduk yang sama dan status 'Menunggu Verifikasi'
        $existingRequest = TempPendudukModel::where('id_penduduk', $penduduk->id_penduduk)
            ->where('status', 'Menunggu Verifikasi')
            ->exists();

        if ($existingRequest) {
            // Jika ada, beri respons yang sesuai
            return redirect()->back()->with('error', 'Anda sudah mengajukan perubahan data. Harap tunggu proses verifikasi sebelum mengajukan perubahan lagi.');
        }

        $penduduk = UserModel::find($penduduk->id_penduduk);
        // Buat entri baru di tabel TempPendudukModel
        TempPendudukModel::create([
            'id_penduduk' => $penduduk->id_penduduk, // Atur field kunci asing yang sesuai
            'urlProfile' => $penduduk->urlProfile,
            'nik' => $penduduk->nik,
            'no_reg' => $request->no_reg ? $request->no_reg : $penduduk->no_reg, // Gunakan nilai yang diinput jika ada, jika tidak gunakan nilai sebelumnya
            'tgl_lahir' => $request->tgl_lahir ? $request->tgl_lahir : $penduduk->tgl_lahir,
            'nama' => $request->nama ? $request->nama : $penduduk->nama,
            'tempat_lahir' => $request->tempat_lahir ? $request->tempat_lahir : $penduduk->tempat_lahir,
            'jenis_kelamin' => $request->jenis_kelamin ? $request->jenis_kelamin : $penduduk->jenis_kelamin,
            'rt' => $request->rt ? $request->rt : $penduduk->rt,
            'umur' => $request->umur ? $request->umur : $penduduk->umur,
            'status_kawin' => $request->status_kawin ? $request->status_kawin : $penduduk->status_kawin,
            'status_keluarga' => $request->status_keluarga ? $request->status_keluarga : $penduduk->status_keluarga,
            'agama' => $request->agama ? $request->agama : $penduduk->agama,
            'alamat' => $request->alamat ? $request->alamat : $penduduk->alamat,
            'pendidikan' => $request->pendidikan ? $request->pendidikan : $penduduk->pendidikan,
            'pekerjaan' => $request->pekerjaan ? $request->pekerjaan : $penduduk->pekerjaan,
            'akseptor_kb' => $request->akseptor_kb ? $request->akseptor_kb : $penduduk->akseptor_kb,
            'jenis_akseptor' => $request->jenis_akseptor ? $request->jenis_akseptor : $penduduk->jenis_akseptor,
            'aktif_posyandu' => $request->aktif_posyandu ? $request->aktif_posyandu : $penduduk->aktif_posyandu,
            'has_BKB' => $request->has_BKB ? $request->has_BKB : $penduduk->has_BKB,
            'has_tabungan' => $request->has_tabungan ? $request->has_tabungan : $penduduk->has_tabungan,
            'ikut_kel_belajar' => $request->ikut_kel_belajar ? $request->ikut_kel_belajar : $penduduk->ikut_kel_belajar,
            'jenis_kel_belajar' => $request->jenis_kel_belajar ? $request->jenis_kel_belajar : $penduduk->jenis_kel_belajar,
            'ikut_paud' => $request->ikut_paud ? $request->ikut_paud : $penduduk->ikut_paud,
            'ikut_koperasi' => $request->ikut_koperasi ? $request->ikut_koperasi : $penduduk->ikut_koperasi,
        ]);
        // Anda dapat mengembalikan respons yang sesuai, misalnya:
        return redirect()->back()->with('success', 'Formulir pengajuan edit berhasil disimpan.');
    }
    public function historyEditData(UserModel $penduduk)
    { //history dan status untuk penduduk
        $history = TempPendudukModel::where('id_penduduk', $penduduk->id_penduduk);
        return view('user._dasawismaData.history', ['pages' => 'Data Penduduk', 'history' => $history]);
    }
}
