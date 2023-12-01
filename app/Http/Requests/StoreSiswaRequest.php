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
            'kelas' => 'required',
            'angkatan' => 'required|numeric',
            'jurusan' => 'required',
            'jk' => 'required',
            //usernya
            'email' => 'unique',
        ];
    }

    public function messages(): array
    {
        return [
            'nis.required' => ':attribute Tidak Boleh Kosong',  
            // 'nis.unique' => ':attribute NIS Sudah Ada',
            'nama.required' => ':attribute Tidak Boleh Kosong',
            'jk.required' => 'Pilih Salah Satu',
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
            'angkatan' => 'Angkatan',
            'jurusan' => 'Jurusan',
        ];
    }
}
