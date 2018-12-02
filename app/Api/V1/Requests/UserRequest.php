<?php

namespace App\Api\V1\Requests;

use App\Helpers\RuleHelper;
use App\User;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'email'=>'required|email|max:255|unique:users,email',
            'phone_number'=>'required|max:255|unique:users,phone_number',
            'cni'=>'required|max:20|unique:users,cni',
            'first_name'=>'max:255|min:2',
            'last_name'=>'required|max:255|min:2',
            'picture'=>'image',
            'failed_password_attemps'=>'interger',
            'is_active'=>'boolean',
            'status'=>'required|min:0|max:255'.Rule::in(User::$Status),
            'password'=>'required|min:6',
            'patner_id'=>'integer|exists:patners,id',
            'last_device_id'=>'integer|exists:devices,id',
            'last_login'=>'date',
            'settings'=>'',

        ];

        if($this->method()=='PUT'){
            $rules['cni'].=',' .$this->route('users');
            $rules['email'].=',' .$this->route('users');
            $rules['phone_number'].=',' .$this->route('users');
        }


        return RuleHelper::get_rules($this->method(),$rules);
    }
}
