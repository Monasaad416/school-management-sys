<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLevelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.

     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    //   $validated = $request->validate([
//         'list_levels.*.name_ar' => 'required',
//         'list_levels.*.name_en' => 'required',
//     ]);

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //form repeater inputs
            'list_levels.*.name_ar' => 'required',
            'list_levels.*.name_en' => 'required',
            'list_levels.*.grade_id' => 'required',
        ];
    }



    public function messages()
{
    return [
        'list_levels.*.name_ar.required' => trans('validation.required'),
        'list_levels.*.name_en.required' => trans('validation.required'),
        'list_levels.*.grade_id.required' => trans('validation.required'),
    ];
}
}
