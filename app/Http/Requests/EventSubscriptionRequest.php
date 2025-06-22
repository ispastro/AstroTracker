<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'event_id' => ['required', 'exists:celestial_events,id'],
        ];
    }
}
