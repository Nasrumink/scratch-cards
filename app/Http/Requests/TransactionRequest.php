<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;
class TransactionRequest extends FormRequest
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
                'transaction_amount' => 'required|regex:/^\d+(\.\d{1,2})?$/|gt:1',
                'user_id' => 'required|exists:users,id',
                'scratch_card_id' => 'required|exists:scratch_cards,id'
            ];
        }

        return [];
    }

}
