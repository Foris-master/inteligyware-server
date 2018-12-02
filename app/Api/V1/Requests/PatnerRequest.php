<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use App\Patner;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatnerRequest extends FormRequest
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
            'logo'=>'image',
            'phone_number'=>'required|email|min:9|max:15',
            'address'=>'required|min:0|max:255',
            'is_active'=>'boolean',
            'status'=>'max:20|'.Rule::in(Patner::$Status),
            'town_id'=>'required|integer|exists:towns,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
