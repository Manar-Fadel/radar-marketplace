<?php

namespace App\Http\Requests\Api;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'phone_number' => 'required|string|max:20',
            'user_type' => 'required|in:'.Constants::BANK_DELEGATE.','.Constants::DEALER,
            'document_url' => 'nullable|string'
        ];
    }
}
