<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
            'jenis' => 'required',
            'metode' => 'required',
            'jumlah' => 'required|numeric',
            'urlBuktiPembayaran' => 'required|mimes:jpeg,png,jpg|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'jenis.required' => 'Jenis pembayaran wajib diisi.',
            'metode.required' => 'Metode pembayaran wajib diisi.',
            'urlBuktiPembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'urlBuktiPembayaran.file' => 'Bukti pembayaran harus berupa file.',
            'urlBuktiPembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpeg, png, jpg.',
            'urlBuktiPembayaran.max' => 'Ukuran file bukti pembayaran tidak boleh lebih dari 2MB.'
        ];
    }
}
