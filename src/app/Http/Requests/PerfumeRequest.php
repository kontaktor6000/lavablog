<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerfumeRequest extends FormRequest
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
            'name'                => 'required|min:3|max:10',
            'slug'                => 'required|string|min:3|max:10',
            'description'         => 'required|min:10',
            'big_icon'            => 'required|image',
            'small_icon'          => 'required|image',
            'category'            => 'required|integer|exists:perfume_categories,id',
        ];
    }

    public function messages()
    {
        return [
            'required'                              => 'Поле :attribute обязательно для заполнения',
            'min'                                   => 'Поле :attribute должно содержать не менее 3-х символов',
            'max'                                   => 'Поле :attribute должно содержать не более 10-ти символов',
            'description.min'                       => 'Поле :attribute должно содержать не менее 10-ти символов',
            'string'                                => 'Поле :attribute должно быть строкой',
            'image'                                 => 'Поле :attribute должно быть изображением',
            'integer'                               => 'Поле :attribute должно быть натуральным числом',
            'category.exists:perfume_categories,id' => 'Поле :attribute обязательно должно быть в таблице perfume_categories',
        ];
    }


}
