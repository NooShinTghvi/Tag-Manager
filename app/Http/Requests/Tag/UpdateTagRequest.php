<?php

namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Tag $tag
     * @return bool
     */
    public function authorize(Tag $tag): bool
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
            'name' => ['required', 'string', 'max:75', Rule::unique('tags')->ignore($this->tag->id)],
            'slug' => 'required|string|max:120',
            'description' => 'nullable|string|max:255',
        ];
    }
}
