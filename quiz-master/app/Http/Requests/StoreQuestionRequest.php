<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'question' => 'required',
            'options' => 'required|array|min:3|max:5',
            'options.*.option' => 'required|string',
            'options.*.is_correct' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'options.*.option' => 'Option text is required.',
            'options.*.is_correct' => 'There must be atleast one correct option.',
        ];
    }
}
