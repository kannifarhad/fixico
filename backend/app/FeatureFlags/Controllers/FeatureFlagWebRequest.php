<?php

namespace App\FeatureFlags\Controllers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FeatureFlagWebRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // $this->route('flag') may be a FeatureFlag model (route model binding)
        $flag = $this->route('flag');
        $id = null;

        if ($flag) {
            // If it's a model, get id; if it's an id, use it as-is
            $id = is_object($flag) ? ($flag->id ?? null) : $flag;
        }

        return [
            'key' => [
                'required',
                'string',
                'max:255',
                Rule::unique('feature_flags', 'key')->ignore($id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'enabled' => ['boolean'],
            'rules' => ['nullable', 'json'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }
}