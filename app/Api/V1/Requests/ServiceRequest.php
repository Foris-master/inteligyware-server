<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
            'description' => 'required|min:2|max:255',
            'code' => 'unique:services,code',
            'service_id' => 'integer|exists:services,id',
        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
