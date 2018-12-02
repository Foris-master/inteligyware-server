<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class MobileOperatorRequest extends FormRequest
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
            'name'=>'required|min:0|max:255',
            'code'=>'required|min:0|max:255',
            'logo'=>'image',
            'country_id' => 'integer|exists:countries,id'

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
