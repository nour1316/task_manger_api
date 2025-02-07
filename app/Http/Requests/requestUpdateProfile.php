<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class requestUpdateProfile extends FormRequest
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
          
               // 'user_id'=>  'sometimes|required|exists:users,id',
                'phone'=> 'sometimes|nullable|string',
                'adress'=> 'sometimes|nullable|string',
                'bio'=> 'sometimes|nullable|string',
                'img'=> 'sometimes|nullable|string',
             ];
        
        
    }
}
