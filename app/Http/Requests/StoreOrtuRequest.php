<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrtuRequest extends FormRequest
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
            'nik' => 'required|numeric|digits:16',
            'nama_ortu' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric|min:10',

        ];
    }

    public function messages(): array
    {
        return [
            'nik.required' => ':attribute Tidak Boleh Kosong',
            'nama_ortu.required' => ':attribute Tidak Boleh Kosong',
            'alamat.required' => ':attribute Tidak Boleh Kosong',
            'no_telp.required' => ':attribute Tidak Boleh Kosong',
        ];
    }
    public function attributes(): array
    {
        return [
            'nik' => 'NIK',
            'nama_ortu' => 'Nama',
            'alamat' => 'Alamat',
            'no_telp' => 'Nomor Telepon',
        ];
    }
}
