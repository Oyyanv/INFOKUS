<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
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
            'nik' => 'nullable|numeric|digits:16',
            'nama' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            // 'nis.required' => ':attribute Tidak Boleh Kosong',
            // 'nik.required' => ':attribute Tidak Boleh Kosong',
            // 'nik.unique' => ':attribute Sudah Ada',
            // 'nis.unique' => ':attribute Sudah Ada',
            'nama.required' => ':attribute Tidak Boleh Kosong',
            'jk.required' => ':attribute Tidak Boleh Kosong',
            'kelas.required' => ':attribute Harus Dipilih',
            'jurusan.required' => ':attribute Harus Dipilih',
        ];
    }
    public function attributes(): array
    {
        return [
            'nis' => 'NIS',
            'nik' => 'NIK',
            'nama' => 'Nama',
            'kelas' => 'Kelas',
            'angkatan' => 'Angkatan',
            'jurusan' => 'Jurusan',
        ];
    }
}
