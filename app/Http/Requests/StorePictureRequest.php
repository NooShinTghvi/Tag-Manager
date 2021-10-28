<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePictureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'picture' => 'required|image|mimes:jpeg,png,gif,svg|max:25000', //25000 KB
        ];
    }
}
