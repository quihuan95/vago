<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'in:male,female,other'],
            'academic_title' => ['nullable', 'string', 'max:150'],
            'specialty' => ['nullable', 'string', 'max:150'],
            'organization' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:150'],
            'address' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:150'],
            'member_type' => ['nullable', 'string', 'max:100'],
            'attachment' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx', 'max:5120'],
            'notes' => ['nullable', 'string', 'max:3000'],
            // Honeypot: must always be empty. Real users never see or fill this field.
            'website' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('site.member_field_full_name'),
            'date_of_birth' => __('site.member_field_dob'),
            'gender' => __('site.member_field_gender'),
            'academic_title' => __('site.member_field_academic_title'),
            'specialty' => __('site.member_field_specialty'),
            'organization' => __('site.member_field_organization'),
            'job_title' => __('site.member_field_job_title'),
            'phone' => __('site.member_field_phone'),
            'email' => __('site.member_field_email'),
            'address' => __('site.member_field_address'),
            'province' => __('site.member_field_province'),
            'member_type' => __('site.member_field_member_type'),
            'attachment' => __('site.member_field_attachment'),
            'notes' => __('site.member_field_notes'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'website' => $this->input('website', ''),
        ]);
    }

    public function safeData(): array
    {
        return $this->safe()->except(['website', 'attachment']);
    }
}
