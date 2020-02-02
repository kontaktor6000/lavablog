<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreRequest extends FormRequest
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
            'bookName'             => 'required|min:3|max:100',
            'year'                 => "required|digits:4|integer|min:0001|max:$currentYear",
            'authorId'             => 'required|integer|exists:books,author_id',
            'publishingHouseId'    => 'required|integer|exists:books,publishing_house_id',
        ];

    }

    public function messages()
    {
        return [
            'required'                              => 'Поле :attribute обязательно для заполнения',
            'min'                                   => 'Поле :attribute должно содержать не менее 3-х символов',
            'bookName.max'                          => 'Поле :attribute не должно быть больше 100 символов',
            'year.digits'                           => 'Поле :attribute должно быть четырехразрядным, в пределах от 0001 до текущего года',
            'year.max'                              => 'Поле :attribute не должно быть больше текущего года',
            'integer'                               => 'Поле :attribute должно быть натуральным числом',
            'exists:books,publishing_house_id'      => 'Поле :attribute обязательно должно быть в таблице books',
            'exists:books,author_id'                => 'Поле :attribute обязательно должно быть в таблице books',
        ];
    }



}
