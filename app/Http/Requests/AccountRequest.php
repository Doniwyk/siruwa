<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_user' => 'required',
            'nama' => 'required',
            'password' => 'required',
            'asAdminn' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'id_user.required' => 'ID User wajib diisi.',
            'nama.required' => 'Nama wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'isAdmin.required' => 'Status Admin wajib diisi'
        ];
    }
}
