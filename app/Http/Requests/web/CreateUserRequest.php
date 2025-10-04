<?php

namespace App\Http\Requests\web;

use App\Managers\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        if ($request->isMethod('POST')) {
            return [
                'full_name' => 'required|string|max:255',
                'id_number' => 'required|string|max:20|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:4',
                'password_confirmation' => 'required|string|min:4|same:password',
                'phone_number' => 'required|unique:users|string|max:20',
                'user_type' => 'required|in:' . Constants::BANK_DELEGATE . ',' . Constants::DEALER,
                'document_url' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc|max:2048',
                'showroom_doc' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,doc|max:2048',
            ];
        }else{
            return [];
        }
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){

        $errors = $validator->errors();
        return Redirect::back()->with(['errors' => $errors, 'error' => $errors->first()]);
    }

}
