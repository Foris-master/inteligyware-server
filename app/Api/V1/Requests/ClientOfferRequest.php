<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class ClientOfferRequest extends FormRequest
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
            'client_id'=>'required|integer|exists:clients,id',
            'offer_id'=>'required|integer|exists:offers,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
