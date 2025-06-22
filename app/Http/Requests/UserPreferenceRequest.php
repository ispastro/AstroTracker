<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPreferenceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'interested_event_types' => ['nullable', 'array'],
            'interested_event_types.*' => ['string', 'in:meteor_shower,eclipse,planet,satellite,comet,asteroid'],
            'preferred_location' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'receive_email_notifications' => ['boolean'],
        ];
    }
}
