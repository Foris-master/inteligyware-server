<?php

namespace App\Api\V1\Requests;



use App\Client;
use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
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
            'email'=>'required|email|min:0|max:255',
            'phone_number'=>'required|email|min:9|max:15',
            'type'=>'max:20|'.Rule::in(Client::$Types),
            'patner_id'=>'required|integer|exists:patners,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
