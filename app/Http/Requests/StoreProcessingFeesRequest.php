<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessingFeesRequest extends FormRequest
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
            'student_id' =>'required|exists:students,id',
            'debit' =>'required|numeric',
            'description' =>'required|string',
        ];
    }

    
    public function messages()
    {
        return [
            'student_id.required' => trans('validation.required'),
            'final_balance.required' => trans('validation.required'),
            'debit.numeric' => trans('validation.numeric'),
            'description.required' => trans('validation.required'),
            'description.string' => trans('validation.string'),
        ];
    }
}
