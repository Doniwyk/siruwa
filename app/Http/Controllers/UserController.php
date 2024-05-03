<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\UserRequest;
use App\Models\PendudukModel;
use App\Models\TempPendudukModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    //
    protected UserContract $pendudukContract;

    public function __construct(UserContract $pendudukContract)
    {
        $this->pendudukContract = $pendudukContract;
    }

    public function index(){
        $resident = UserModel::all();
        return view('admin._dasawismaData.index', ['pages' => 'Data Penduduk','resident' => $resident]);
    }

    public function add(){
        return view('admin._dasawismaData.add');
    }

    public function storeUser(UserRequest $request):RedirectResponse{
        $validated=$request->validated();
        $this->pendudukContract->storeUser($validated);
        return redirect()->route('data-dasawisma')->with('success', 'Data penduduk berhasil ditambahkan.');    
    }

    public function editUser(UserModel $penduduk):View{
        return view('admin._dasawismaData.edit', compact('penduduk'));
    }

    public function updateUser(UserRequest $request, UserModel $penduduk):RedirectResponse{
        $validated = $request->validated();
        $this->pendudukContract->updateUser($validated, $penduduk);

        return redirect()->route('data-dasawisma')->with('success', 'Data penduduk berhasil di ubah');
    }

    public function deleteUser(UserModel $penduduk): RedirectResponse{
        $this->pendudukContract->deleteUser($penduduk);
        
        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil di hapus.');


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
    public function processEditForm(Request $request, string $id): RedirectResponse
    {
        $penduduk = UserModel::find($id)->first();
        // Buat entri baru di tabel TempPendudukModel
        TempPendudukModel::create([
            'nik' => $penduduk->nik, // Atur field kunci asing yang sesuai
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
            // Tambahkan field lainnya sesuai kebutuhan
        ]);

        // Anda dapat mengembalikan respons yang sesuai, misalnya:
        return redirect()->back()->with('success', 'Formulir pengajuan edit berhasil disimpan.');
    }
}
