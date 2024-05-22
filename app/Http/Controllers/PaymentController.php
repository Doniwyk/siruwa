<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentContract;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\PaymentModel;
use App\Models\DeathFundModel;
use App\Models\GarbageFundModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    protected PaymentContract $paymentContract;

    public function __construct(PaymentContract $paymentContract)
    {
        $this->paymentContract = $paymentContract;
    }

    public function index()
    {
        $payment = PaymentModel::all();
        $page = 'data-pembayaran';
        $title = 'Manajemen Dana';
        return view('admin._fund.index', ['title' => $title, 'page' => $page]);
        // return view('payment.index',compact('payment'));
        //jangan lupa menyesuaikan nama view
    }

    public function add()
    {
        return view('admin._fund.add');
        //jangan lupa menyesuaikan nama view
    }

    public function storePayment(PaymentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $this->paymentContract->storePayment($validated);

        return redirect()->route('admin.manajemen-dana.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function editPayment(PaymentModel $payment): View
    {
        return view('admin._fund.edit', compact('payment'));
    }

    public function updatePayment(NewsRequest $request, PaymentModel $payment): RedirectResponse
    {
        $validated = $request->validated();
        $this->paymentContract->updatePayment($validated, $payment);

        return redirect()->route('admin.manajemen-dana.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function deletePayment(PaymentModel $payment): RedirectResponse
    {
        $this->paymentContract->deletePayment($payment);

        return redirect()->route('admin.manajemen-dana.index')->with('success', 'Berita berhasil di hapus.');
    }
    public function validatePembayaran(Request $request, PaymentModel $payment): RedirectResponse
    {
        // Validasi data yang diterima dari form validasi
        $validatedData = $request->validate([
            'jumlah' => 'required|numeric|min:0',
            'metode' => 'required|in:Tunai,Transfer',
        ]);

        // Update status pembayaran
        $payment->status = 'Terverifikasi';
        $payment->save();

        // Ubah status bulan pada tabel IuranKematian atau IuranSampah
        $totalPembayaran = $validatedData['jumlah'];
        $iuranPerBulan = 10000;
        $jumlahBulanLunas = (int)($totalPembayaran / $iuranPerBulan);

        // Tentukan model dan tabel yang sesuai berdasarkan jenis pembayaran
        $table = $payment->jenis === 'Kematian' ? DeathFundModel::class : GarbageFundModel::class;

        // Temukan bulan terlama yang statusnya 'Belum Lunas'
        $bulanTerlama = $table::where('status', 'Belum Lunas')
            ->orderBy('bulan', 'asc')
            ->first();

        // Jika bulan terlama ditemukan, ambil bulannya, jika tidak, gunakan bulan saat ini
        $bulan = $bulanTerlama ? $bulanTerlama->bulan : date('Y-m');

        for ($i = 0; $i < $jumlahBulanLunas; $i++) {
            $table::update([
                'id_pembayaran' => $payment->id_pembayaran,
                'bulan' => $bulan,
                'status' => 'Lunas'
            ]);
    
            // Ubah bulan untuk perulangan berikutnya
            $bulan = date('Y-m', strtotime("$bulan +1 month"));
        }
        return redirect()->route('payment.index')->with('success', 'Pembayaran berhasil divalidasi.');
    }
}
