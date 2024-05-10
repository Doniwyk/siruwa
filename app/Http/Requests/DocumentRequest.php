<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'id_penduduk' => 'required',
            'jenis' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'id_penduduk.required' => 'Penduduk wajib diisi',
            'jenis.required' => 'The email field is required.'
        ];
    }
}
