<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CelestialEventRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'type' => ['required', 'string', 'in:meteor_shower,eclipse,planet,satellite,comet,asteroid'],
            'starts_at' => ['required', 'date', 'after:now'],
            'ends_at' => ['required', 'date', 'after:starts_at'],
            'visibility_regions' => ['nullable', 'string'],
            'is_global' => ['boolean'],
        ];
    }
}
