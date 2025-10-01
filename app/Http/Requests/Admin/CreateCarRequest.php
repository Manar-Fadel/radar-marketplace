<?php

namespace App\Http\Requests\Admin;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'required|integer|exists:brands,id',
            'model_id' => 'required|integer|exists:car_models,id',
            'price' => 'required|numeric',
            'mileage' => 'nullable|integer',
            'fuel_type' => 'nullable|string',
            'transmission' => 'nullable|string',
            'engine' => 'nullable|string',
            'drive_type' => 'nullable|string',
            'person' => 'nullable|integer',

            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
