<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // req gates for edit  Users
        return Gate::allows('edit', \App\Models\User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'f_name'=> 'required|string|max:255',
            'l_name'=> 'required|string|max:255',
            'email'=> 'required|string|email|max:255|unique:users',
           'password'=> 'required|string|min:8',
            'role_id'=> 'required',
        ];
    }
}
