<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductFormRequest extends FormRequest
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
            'name'          =>  'required|max:255',
            'price'         =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'sale_price'    =>  'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'cost'          =>  'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'sorting'          =>  'required|numeric',
//            'start_date'    =>  'nullable|date|after:'.Carbon::today(),
//            'end_date'      =>  'nullable|date|after:'.Carbon::today(),
        ];
    }
}
