<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:150'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:150'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            // Honeypot: must always be empty. Real users never see or fill this field.
            'website' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('site.contact_field_full_name'),
            'phone' => __('site.contact_field_phone'),
            'address' => __('site.contact_field_address'),
            'email' => __('site.contact_field_email'),
            'subject' => __('site.contact_field_subject'),
            'message' => __('site.contact_field_message'),
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
        return $this->safe()->except(['website']);
    }
}
