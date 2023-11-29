<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagihanRequest extends FormRequest
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
            'tagihan' => 'required|numeric',
            'bulan' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'tagihan.required' => ':attribute Tidak Boleh Kosong',
            'bulan.required' => ':attribute Tidak Boleh Kosong',
        ];
    }
    public function attributes(): array
    {
        return [
            'tagihan' => 'Tagihan',
            'bulan' => 'Bulan',
        ];
    }
}
