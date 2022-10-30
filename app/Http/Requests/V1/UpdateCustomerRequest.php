<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
                'name' => ['required'],
                'type' => ['required', Rule::in(['G', 'U', "A", 'g', 'u', "a"])],
                'email' => ['required', 'email', 'unique:customers']
            ];
        } else {
            return [
                'name' => ['sometimes', 'required'],
                'type' => ['sometimes', 'required', Rule::in(['G', 'U', "A", 'g', 'u', "a"])],
                'email' => ['sometimes', 'required', 'email', 'unique:customers']
            ];
        }
    }
}
