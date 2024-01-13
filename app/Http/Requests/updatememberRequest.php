<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updatememberRequest extends FormRequest
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
            'password' => 'sometimes|required|string',
            'phone_number' => 'sometimes|required|digits_between:10,15',
            'Age' => 'sometimes|required|integer|min:0',
            'illness' => 'sometimes|nullable|string',
            'Hieght' => 'sometimes|required|numeric|min:0',
            'Wieght' => 'sometimes|required|numeric|min:0',
            'target_Wieght' => 'sometimes|required|numeric|min:0',
            'neutritionist_id' => 'sometimes|nullable|exists:neutritionists,id',
            'coach_id' => 'sometimes|nullable|exists:coaches,id',
        ];
    }
}
