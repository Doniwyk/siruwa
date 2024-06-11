<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;

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
            'jumlah' => ['required', 'numeric', new class implements Rule {
                public function passes($attribute, $value)
                {
                    return $value % 10000 === 0;
                }
    
                public function message()
                {
                    return 'Nominal harus kelipatan 10.000';
                }
            }],
            'urlBuktiPembayaran' => 'required|mimes:jpeg,png,jpg|max:1000',
        ];
    }
    public function messages(): array
    {
        return [
            'jenis.required' => 'Jenis pembayaran wajib diisi.',
            'metode.required' => 'Metode pembayaran wajib diisi.',
            'jumlah.required' => 'Nominal wajib diisi.',
            'jumlah.numeric' => 'Nominal harus berupa angka.',
            'urlBuktiPembayaran.required' => 'Bukti pembayaran wajib diupload.',
            'urlBuktiPembayaran.mimes' => 'Bukti pembayaran harus berupa file dengan format: jpeg, png, jpg.',
            'urlBuktiPembayaran.max' => 'Ukuran file bukti pembayaran tidak boleh lebih dari 1MB.'
        ];
    }
}
