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
            'id_user' => 'required',
            'urlProfile' => 'required',
            'no_reg'  => 'required',
            'tgl_lahir' => 'required',
            'nik'  => 'required|string|size:16',
            'nama' => 'required|string',
            'tempat_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'rt' => 'required',
            'umur' => 'required',
            'status_kawin' => 'required',
            'status_keluarga' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'akseptor_kb' => 'required',
            'jenis_akseptor' => 'required',
            'aktif_posyandu' => 'required',
            'has_BKB' => 'required',
            'has_tabungan' => 'required',
            'ikut_kel_belajar' => 'required',
            'jenis_kel_belajar' => 'required',
            'ikut_paud' => 'required',
            'ikut_koperasi' => 'required'

        ];
    }

    public function messages()
    {
        return [
            'id_user.required' => 'ID User wajib diisi.',
            'urlProfile.required' => 'URL profile wajib diisi.',
            'no_reg.required' => 'Nomor registrasi wajib diisi.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.size' => 'NIK harus berjumlah 16 karakter.',
            'nama.required' => 'Nama wajib diisi.',
            'tempat_lahir.required' => 'Tempat lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi.',
            'rt.required' => 'RT wajib diisi.',
            'umur.required' => 'Umur wajib diisi.',
            'status_kawin.required' => 'Status kawin wajib diisi.',
            'status_keluarga.required' => 'Status keluarga wajib diisi.',
            'agama.required' => 'Agama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'pendidikan.required' => 'Pendidikan wajib diisi.',
            'pekerjaan.required' => 'Pekerjaan wajib diisi.',
            'akseptor_kb.required' => 'Akseptor KB wajib diisi.',
            'jenis_akseptor.required' => 'Jenis kkseptor wajib diisi.',
            'aktif_posyandu.required' => 'Aktif posyandu wajib diisi.',
            'has_BKB.required' => 'Memiliki BKB wajib diisi.',
            'has_tabungan.required' => 'Memiliki Tabungan wajib diisi.',
            'ikut_kel_belajar.required' => 'Ikut Kelas Belajar wajib diisi.',
            'jenis_kel_belajar.required' => 'Jenis Kelas Belajar wajib diisi.',
            'ikut_paud.required' => 'Ikut PAUD wajib diisi.',
            'ikut_koperasi.required' => 'Ikut Koperasi wajib diisi.'
        ];
    }

}
