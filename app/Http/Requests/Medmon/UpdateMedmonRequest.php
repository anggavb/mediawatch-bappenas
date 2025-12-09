<?php

namespace App\Http\Requests\Medmon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateMedmonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('update', $this->medmon);
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
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'url' => ['sometimes', 'url', 'max:500'],
            'published_at' => ['sometimes', 'date'],
            'media_id' => ['sometimes', 'exists:media,id'],
            'datetime' => ['sometimes', 'date'],
            'tone_content' => ['sometimes', 'nullable', 'string', 'in:Positive,Negative,Neutral'],
        ];
    }
}
