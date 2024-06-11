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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul' => 'required|string|max:255',
            'editor' => 'required|string',
        ];
    }


    public function messages()
    {
        return [
            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: jpeg, png, jpg, gif, svg.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'judul.required' => 'Judul wajib diisi.',
            'judul.string' => 'Judul harus berupa teks.',
            'judul.max' => 'Judul tidak boleh lebih dari 255 karakter.',
            'editor.required' => 'Isi berita wajib diisi.',
    ];
    }
}
