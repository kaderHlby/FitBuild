<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatecoacheRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string',
            'WorkHours'=>'sometimes|required|string',
            'Work_at'=>'sometimes|required|string',
            'password' => 'sometimes|required|string',
            'phone_number' => 'sometimes|required|digits_between:10,15',
            'Age' => 'sometimes|required|integer|min:0',
        ];
    }
}
