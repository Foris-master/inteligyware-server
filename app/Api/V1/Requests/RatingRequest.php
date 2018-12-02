<?php

namespace App\Api\V1\Requests;

use App\Helpers\RuleHelper;
use Dingo\Api\Http\FormRequest;

class RatingRequest extends FormRequest
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
            'ratingable_id'=>'required|required_with:ratingable_type|integer',
            'ratingable_type'=>'required_with:ratingable_id|max:255',
            'author_id'=>'required|required_with:author_type|integer',
            'author_type'=>'max:255',
            'rating' => 'required|numeric'

        ];


        return RuleHelper::get_rules($this->method(), $rules,[]);
    }
}
