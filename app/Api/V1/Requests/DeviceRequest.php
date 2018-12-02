<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class DeviceRequest extends FormRequest
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
            'type'=>'required|min:0|max:255',
            'description'=>'',
            'user_id'=>'required|integer|exists:users,id'
        ];

        return RuleHelper::get_rules($this->method(),$rules);
    }
}
