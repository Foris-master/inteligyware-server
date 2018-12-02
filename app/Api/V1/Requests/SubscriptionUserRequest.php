<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubscriptionUserRequest extends FormRequest
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
            'is_valid' => 'boolean',
            'auto_renew' => 'boolean',
            'expiration_date' => 'date',
            'subscription_date' => 'date',
            'remaining_amount' => 'required|numeric',
            'remaining_transaction' => 'required|integer',
            'patner_id' => 'required|integer|exists:patners,id',
            'subscription_id' => 'required|integer|exists:subscriptions,id',
        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
