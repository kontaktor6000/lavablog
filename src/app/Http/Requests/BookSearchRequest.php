<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookSearchRequest extends FormRequest
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
            'query' => 'required|min:3|max:100'
        ];
    }


    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для заполнения',
            'min'      => 'Поле :attribute должно содержать не менее 3-х символов',
            'max'      => 'Поле :attribute должно содержать не более 100 символов',
        ];
    }

}
