<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'id_admin' => 'required',
            'judul' => 'required',
            'isi' => 'required'
        ];
    }


    public function messages()
    {
        return [
        'id_admin.required' => 'ID Admin wajib diisi.',
        'judul.required' => 'Judul berita wajib diisi.',
        'isi.required' => 'Isi berita wajib diisi.'
    ];
    }
}
