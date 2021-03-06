<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstructorUpdateRequest extends FormRequest
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
        return [
            'fullname' => 'required|max:100',
            'egender' => 'required',
            'email' => 'required|max:150',
            'phone' => 'required',
            'birthday' => 'required',
            'image' => 'mimes:jpeg,bmp,png'
        ];
    }
}
