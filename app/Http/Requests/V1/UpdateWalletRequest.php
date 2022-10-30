<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWalletRequest extends FormRequest
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
                'customerId' => ['required', 'integer'],
                'name' => ['required']
            ];
        } else {
            return [
                'customerId' => ['sometimes', 'required', 'integer'],
                'name' => ['sometimes', 'required']
            ];
        }
    }

        protected function prepareForValidation() {
        $this->merge([
            'customer_id' => $this->customerId
        ]);
    }
}
