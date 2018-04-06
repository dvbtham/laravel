<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentFormRequest extends FormRequest
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
            'gender' => 'required',
            'email' => 'required|max:150',
            'nickname' => 'max:100',
            'hobbies' => 'max:100',
            'birthday' => 'required'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    //public function messages()
    //{
        // return [
        //     'fullname.required' => 'Bạn chưa nhập họ tên',
        //     'fullname.max'  => 'Chỉ nhập tối đa 100 ký tự',
        // ];
   // }
}
