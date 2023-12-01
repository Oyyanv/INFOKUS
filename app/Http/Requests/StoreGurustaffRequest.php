<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGurustaffRequest extends FormRequest
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
            'nip' => 'required|unique:gurustaffs,id_nip|numeric|digits:18',
            'nama' =>'required',
            'jk' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'nip.digits' => ':attribute Wajib 18 Digit',
            'nama.required' => ':attribute Tidak Boleh Kosong',
            'jk.required' => ' Pilih Salah Satu',
            'status.required' => ' Pilih Salah Satu',
            'nip.required' => ':attribute Tidak Boleh Kosong',
            'nip.unique' => ':attribute Sudah Ada',
        ];
    }
    public function attributes(): array
    {
        return [
            'nip' => 'NIP',
            'nama' => 'Nama',
        ];
    }
}
