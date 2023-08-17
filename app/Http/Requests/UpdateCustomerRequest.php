<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:50'],
            'kana' => ['required', 'regex:/^[ァ-ヾ\s]+$/u','max:50'],
            'tel' => ['required', 'max:20', Rule::unique('customers')->ignore($this->customer->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('customers')->ignore($this->customer->id)],
            'postcode' => ['required', 'max:7'],
            'address' => ['required', 'max:100'],
            'birthday' => ['date', 'nullable'],
            'gender' => ['required'],
            'memo' => ['max:1000'],
        ];
    }
}
