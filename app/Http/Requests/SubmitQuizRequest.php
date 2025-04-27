<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuizRequest extends FormRequest
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
            'student_id'            => ['required', 'exists:students,id'],
            'answers'               => ['required', 'array', 'min:1'],
            'answers.*.question_id' => ['required', 'exists:questions,id'],
            'answers.*.option_id'   => ['required', 'exists:question_options,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'student_id.required'            => 'The student_id field is required.',
            'student_id.exists'              => 'The selected student_id is invalid.',
            'answers.required'               => 'The answers field is required.',
            'answers.array'                  => 'The answers field must be an array.',
            'answers.min'                    => 'At least one answer is required.',
            'answers.*.question_id.required' => 'The question_id field is required.',
            'answers.*.question_id.exists'   => 'The selected question_id is invalid.',
            'answers.*.option_id.required'   => 'The option_id field is required.',
            'answers.*.option_id.exists'     => 'The selected option_id is invalid.',
        ];
    }
}
