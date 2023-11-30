<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
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
            'nis' => 'required|numeric|digits:9',
            'nik' => 'nullable|numeric',
            'nama' => 'required',
            'jk'   => 'required',
            'kelas' => 'required',
            'angkatan' => 'required|numeric',
            'jurusan' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => ':attribute Tidak Boleh Kosong',
            'nama.required' => ':attribute Tidak Boleh Kosong',
            'jk.required' => ':attribute Tidak Boleh Kosong',
            'kelas.required' => ':attribute Harus Dipilih',
            'angkatan.required' => ':attribute Tidak Boleh Kosong',
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
            'jk'    => 'JK',
            'angkatan' => 'Angkatan',
            'jurusan' => 'Jurusan',
        ];
    }
}
