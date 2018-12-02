<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class StationRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'bail' => 'required|integer',
            'identifier' => 'required|min:0|max:255|unique:stations,identifier',
            'code' => 'unique:services,code',
            'patner_id' => 'required|integer|exists:patners,id',
            'mobile_operator_id' => 'required|integer|exists:mobile_operators,id',
        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
