<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use App\PointOfSale;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class PointOfSaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $rules = [
            'name'=>'required|min:0|max:255',
            'picture'=>'image',
            'address_id'=>'required|integer|exists:addresses,id',
            'patner_id'=>'required|integer|exists:patners,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
