<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
                'name_en' => 'required',
                'name_ar' => 'required',
                'email' => 'required|email',
                'password' =>'required|string|min:5|max:25',
                'specialization_id' => 'required|exists:specializations,id',
                'gender_id' => 'required|exists:genders,id',
                'joinning_date' => 'required|date',
                'address' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'email.email' => trans('validation.email'),
            'password.required' => trans('validation.required'),
            'spaecialization_id.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'joinning_date.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
        ];
    }



}
