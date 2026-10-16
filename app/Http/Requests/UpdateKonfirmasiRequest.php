<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class UpdateKonfirmasiRequest extends FormRequest
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
           'nip' => 'required|digits:18', 
           'status'=> 'required'
        ];
    }

    public function message(): array
    {
        return [
            'nip.digits'=> ':attribute Wajib 18 Digit',
            'nip.required'=> ':attribute Tidak Boleh Kosong',
            'status.required'=> ':attribute Harus Dipilih',
        ];
    }

    public function attributes(): array
    {
        return [
            'nip'=>'NIP',
            'status'=> 'Status'
        ];
    }
}
