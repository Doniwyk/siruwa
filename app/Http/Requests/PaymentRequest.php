<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'id_penduduk' => 'required',
            'id_admin' => 'required',
            'jenis' => 'required',
            'metode' => 'required',
            'jumlah' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'id_penduduk.required' => 'ID Penduduk wajib diisi',
            'id_admin.required' => 'ID Admin wajib diisi.',
            'jenis.required' => 'Jenis pembayaran wajib diisi',
            'metode.required' => 'Metode pembayaran wajib diisi',
            'jumlah.required' => 'Jumlah pembayaran wajib diisi'

        ];
    }
}
