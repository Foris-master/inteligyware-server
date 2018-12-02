<?php

namespace App\Api\V1\Requests;



use App\Helpers\RuleHelper;
use App\Patner;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
            'amount'=>'required|numeric',
            'amount_paid'=>'required|numeric',
            'reference'=>'required|min:0|max:255',
            'proof'=>'required|image',
            'pdf'=>'file',
            'payment_date'=>'date',
            'bill_id'=>'required|integer|exists:bills,id',
            'currency_id'=>'required|integer|exists:currencies,id',

        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }
}
