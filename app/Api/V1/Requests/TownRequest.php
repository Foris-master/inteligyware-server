<?php

namespace App\Api\V1\Requests;

use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class TownRequest extends FormRequest
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
            'district'=>'min:0|max:255',
            'code'=>'required|min:0|max:255|unique:towns,code',
            'country_id'=>'required|integer|exists:countries,id',
        ];
        if($this->method()=='PUT'){
            $rules['code'].=',' .$this->route('towns');
        }
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
