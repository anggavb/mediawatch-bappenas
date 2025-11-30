<?php

namespace App\Http\Requests\Media;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update', $this->medium);
        // return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|required|string|max:255|unique:media,url,' . $this->medium->id,
            'logo' => 'nullable|string|max:255',
            'favicon' => 'nullable|string|max:255',
            'media_category_id' => 'sometimes|required|exists:media_categories,id',
            'parent_id' => 'nullable|exists:media,id',
        ];
    }
}
