<?php

namespace App\Http\Requests\Admin;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->route('id'),
            'phone_number' => 'required|string|max:20',
            'user_type' => 'required|in:'.Constants::BANK_DELEGATE.','.Constants::DEALER,
        ];
    }
}
