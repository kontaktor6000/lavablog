<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileStudentRequest extends FormRequest
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
        $currentYear = date('Y');
        return [
            'first_name'    => 'required|min:3|max:30',
            'middle_name'   => 'required|min:3|max:30',
            'last_name'     => 'required|min:3|max:30',
            'profile_image' => 'image|max:2048|mimes:jpeg,png,gif',
            /*'birthday'      => "required|max:' . $currentYear . ",*/
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'min' => 'Поле :attribute должно содержать не менее 3-с символов',
            'max' => 'Поле :attribute должно содержать не более 30-ти символов',
            'image' => 'Поле :attribute должно быть картинкой',
            'birthday.max' => 'Поле :attribute не может быть больше текущего года',
        ];
    }




}
