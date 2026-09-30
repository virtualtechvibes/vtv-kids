<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInquiryRequest extends FormRequest
{
    protected $redirectRoute = 'free-class';

    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, array<int, mixed>> */
    public function rules(): array
    {
        return [
            'parent_name' => ['required', 'string', 'max:100'],
            'child_name' => ['required', 'string', 'max:100'],
            'class' => ['required', 'integer', 'between:0,8'],
            'child_age' => ['required', 'integer', 'between:3,18', Rule::when(in_array($this->input('interested_in'), ['AI', 'Tuition + AI'], true), ['min:7'])],
            'phone' => ['required', 'string', 'regex:/^(?:\+91[ -]?)?[6-9][0-9]{9}$/'],
            'interested_in' => ['required', Rule::in(['Tuition', 'AI', 'Tuition + AI'])],
            'message' => ['nullable', 'string', 'max:2000'],
            'website' => ['prohibited'],
            'consent' => ['accepted'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid 10-digit Indian mobile number (with optional +91).',
            'child_age.min' => 'The AI program starts at age 7. You can choose Tuition for younger children.',
            'consent.accepted' => 'Please allow us to contact you about this inquiry.',
        ];
    }
}
