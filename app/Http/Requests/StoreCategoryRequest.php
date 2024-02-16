<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\Rule as ValidationRule;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $categoryId = ($this->route('category')) ? Crypt::decrypt($this->route('category')) : null;
        $uniqueRule = ValidationRule::unique('categories')->ignore($categoryId);
        if ($categoryId === null) {
            $uniqueRule = ValidationRule::unique('categories');
        }

        return [
            'name' => [
                'required', // kolom nama harus diisi
                'string', // kolom nama harus berupa string
                'max:255', // panjang kolom nama maksimal 255 karakter
                $uniqueRule, // kolom nama harus unik di tabel categories, ignore the current category ID if exists
            ],
        ];
    }
}
