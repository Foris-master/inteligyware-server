<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class PointOfSaleServiceRequest extends FormRequest
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
            'service_id'=>'required|integer|exists:services,id',
            'point_of_sale_id'=>'required|integer|exists:point_of_sales,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
