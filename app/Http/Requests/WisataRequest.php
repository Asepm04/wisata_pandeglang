<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class WisataRequest extends FormRequest
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
            "nama_wisata" =>['required'],
            "alamat_wisata"=>['required'],
            "tiket"=>['required'],
            "jam_operasional"=>['required'],
            "deskripsi"=>['required'],
            "gambar"=> ['required','image','mimes:jpg,png,jpeg']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
             response()->json(['Message'=>"data wajib diisi"],400)
        );
    }
}
