<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class PointOfSaleServiceStationRequest extends FormRequest
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
            'station_id'=>'required|integer|exists:stations,id',
            'point_of_sale_service_id'=>'required|integer|exists:point_of_sale_services,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
