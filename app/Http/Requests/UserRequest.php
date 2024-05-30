<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nama' => 'required|string',
            'nik'  => 'required|string|size:16',
            'nomor_kk' => 'required',
            'rt' => 'required',
            'alamat' => 'required',
            'pekerjaan' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'agama' => 'required',
            'pendidikan' => 'required',
            'status_kawin' => 'required',
            'status_keluarga' => 'required',
            'has_tabungan' => 'required',
            'akseptor_kb' => 'required',
            'aktif_posyandu' => 'required',
            'ikut_kel_belajar' => 'required',
            'ikut_koperasi' => 'required',
            'ikut_paud' => 'required',
            'has_BKB' => 'required',
            'gaji'=> 'required',
            'pajak_bumi' => 'required',
            'biaya_listrik' => 'required',
            'biaya_air' => 'required',
            'total_pajak_kendaraan' => 'required',

        ];
    }

    public function messages()
    {
        return [


            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'no_kk.required' => 'No KK wajib diisi',
            'nik.size' => 'NIK harus berjumlah 16 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'status_kawin.required' => 'Status kawin wajib diisi.',
            'status_keluarga.required' => 'Status keluarga wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'akseptor_kb.required' => 'Akseptor KB wajib diisi.',
            'aktif_posyandu.required' => 'Aktif posyandu wajib diisi.',
            'has_BKB.required' => 'Memiliki BKB wajib diisi.',
            'has_tabungan.required' => 'Memiliki Tabungan wajib diisi.',
            'ikut_kel_belajar.required' => 'Ikut Kelas Belajar wajib diisi.',
            'ikut_paud.required' => 'Ikut PAUD wajib diisi.',
            'ikut_koperasi.required' => 'Ikut Koperasi wajib diisi.',
            'biaya_listrik.required' => 'Biaya listrik wajib diisi.',
            'biaya_air.required' => 'Biaya listrik wajib diisi.',
            'jumlah_kendaraan_bermotor.required' => 'Jumlah kendaraan bermotor wajib diisi.',
            'pajak_bumi.required' => 'Pajak bumi wajib diisi.',
            'gaji.required' => 'Gaji wajib diisi'
            
        ];
    }

}
