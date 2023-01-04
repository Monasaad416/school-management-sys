<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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

            'list_fees.*.student_id' => 'required|exists:students,id',
            'grade_id' =>  'required|exists:grades,id',
            'level_id' =>  'required|exists:levels,id',
            'list_fees.*.fee_id' =>  'required|exists:fees,id',
            'list_fees.*.amount' =>  'required|numeric',
            'list_fees.*.desciption' =>  'nullable|text'
        ];
    }


    public function messages()
    {
        return [
            'student_id.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'level_id.required' => trans('validation.required'),
            'fee_id.required' => trans('validation.required'),
            'amount.numeric' => trans('validation.numeric'),
            'fee_id.unique' => trans('validation.unique'),
     
        ];
    }
}
