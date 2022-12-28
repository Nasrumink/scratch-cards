<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\Rule;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() == 'POST') {
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ];
        }

        if ($this->method() == 'PATCH') {
            return [
                'email' => 'nullable|exists:users,email',
            ];
        }

        return [];
    }

}
