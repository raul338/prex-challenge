<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveGifRequest extends FormRequest
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
            'gif_id' => [
                'required',
                'string',
                Rule::unique('gifs')
                    ->where('user_id', $this->route('user')),
            ],
            'alias' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'gif_id.unique' => 'Selected gif_id already exists for specified user',
        ];
    }
}
