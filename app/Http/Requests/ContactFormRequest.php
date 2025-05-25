<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|in:provider_application,report_problem,general_message',
            'message' => 'required|string|max:2000',
            'phone_number' => 'nullable|string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'last_name.required' => 'Last name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'subject.in' => 'Please select a valid subject option.',
            'message.required' => 'Message is required.',
            'message.max' => 'Message cannot exceed 2000 characters.',
            'phone_number.max' => 'Phone number cannot exceed 20 characters.',
        ];
    }
}
