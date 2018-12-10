<?php
/**
 * Created by PhpStorm.
 * User: signe
 * Date: 23/10/18
 * Time: 08:38
 */

namespace App\Api\V1\Requests;

use App\Helpers\RuleHelper;
use App\Transaction;
use Dingo\Api\Http\FormRequest;
use Illuminate\Validation\Rule;

class TransactionRequest extends FormRequest
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
            'target_id'=>'required|required_with:target_type|integer|morph_exists:target_type',
            'target_type'=>'max:255|'.Rule::in(Transaction::$Targets),
            'amount'=>'required|numeric',
            'status'=>Rule::in(Transaction::$Status),
            'point_of_sale_service_id'=>'required|integer|exists:point_of_sale_services,id',
            'offer_id'=>'required|integer|exists:offers,id',
            'user_id'=>'required|integer|exists:users,id',
        ];
        return RuleHelper::get_rules($this->method(),$rules);
    }

}