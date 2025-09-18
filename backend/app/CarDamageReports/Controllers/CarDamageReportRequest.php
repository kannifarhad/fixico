<?php

namespace App\CarDamageReports\Controllers;

use Illuminate\Foundation\Http\FormRequest;

class CarDamageReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Adjust if auth is required later
    }

    public function rules(): array
    {
        $id = $this->route('carReport')?->id;

        return [
            'reporter_name' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:20',
            'description' => 'required|string',
            'damage_level' => 'required|in:minor,moderate,severe',
            'is_resolved' => 'sometimes|boolean',
        ];
    }
}