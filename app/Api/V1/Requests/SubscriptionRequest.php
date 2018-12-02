<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionRequest extends FormRequest
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
            'code' => 'unique:subscriptions,code',
            'name' => 'required|min:2|max:255',
            'type' => 'required|min:1|'.Rule::in(['m','y']),
            'price' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'max_transaction' => 'required|integer',
            'description' => 'required',
            'currency_id' => 'required|integer|exists:currencies,id',
        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
