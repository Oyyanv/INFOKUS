<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePembayaranRequest extends FormRequest
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
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'total_pembayaran' => 'required|numeric',
            'tgl_pembayaran' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'bukti_pembayaran.required' => ':attribute Wajib Di Isi',
            'total_pembayaran.required' => ':attribute Tidak Boleh Kosong',
            'tgl_pembayaran.required' => ':attribute Tidak Boleh Kosong',
        ];
    }

    public function attributes(): array
    {
        return [
            'bukti_pembayaran' => 'Bukti Pembayaran',
            'total_pembayaran' => 'Pembayaran',
            'tgl_pembayaran' => 'Tanggal',
        ];
    }
}
