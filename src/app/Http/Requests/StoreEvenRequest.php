<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvenRequest extends FormRequest
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
            'event_name'                => 'required|min:3|max:30',
            'begin_date'                => 'required|date_format:Y-m-d',
            'end_date'                  => 'required|date_format:Y-m-d|after:begin_date',
            'begin_time'                => 'required|date_format:"H:i"',
            'end_time'                  => 'required|date_format:"H:i"',
            'event_image_preview'       => 'image|max:2048|mimes:jpeg,jpg,png,gif',
            'country_id'                => 'integer',
            'basic_cost'                => 'required|numeric|min:10|max:3000',
            'vip_cost'                  => 'required|numeric|min:20|max:5000',
            'event_place'               => 'required|min:3|max:50',
            'event_basic_description'   => 'required|min:30|max:1000',
            'event_vip_description'     => 'required|min:30|max:1000',
            'woman_basic_member'        => 'required|min:0|max:3000',
            'man_basic_member'          => 'required|min:0|max:3000',
            'woman_vip_member'          => 'required|min:0|max:1000',
            'man_vip_member'            => 'required|min:0|max:1000',
            'event_images'              => 'required',
            'event_video'               => 'url|nullable',
        ];
    }
}
