<?php

namespace App\Http\Requests\Media;

use App\Models\Media\Media;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Media::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255|unique:media,url',
            'logo' => 'nullable|string|max:255',
            'media_category_id' => 'required|exists:media_categories,id',
            'media_group_id' => 'nullable|exists:media_groups,id',
        ];
    }
}
