<?php

namespace App\Http\Requests\Medmon;

use App\Models\Medmon\Medmon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreMedmonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Medmon::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'media_id' => 'required|integer|exists:media,id',
            'url' => 'required|string|max:255|unique:medmons,url',
            'datetime' => 'required|date',
            'tone_content' => 'nullable|string|in:Positive,Negative,Neutral',
        ];
    }
}
