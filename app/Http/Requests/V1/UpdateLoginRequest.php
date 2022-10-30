<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLoginRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method = $this->method();

        if($method == 'PUT') {
            return [
                'walletId' => ['required', 'integer'],
                'name' => ['required'],
                'email' => ['required', 'email'],
                'password' => ['required']
            ];
        } else {
            return [
                'walletId' => ['sometimes', 'required', 'integer'],
                'name' => ['sometimes', 'required'],
                'email' => ['sometimes', 'required', 'email'],
                'password' => ['sometimes', 'required']
            ];
        }

    }

    protected function prepareForValidation() {
        $this->merge([
            'wallet_id' => $this->walletId
        ]);
    }
}
