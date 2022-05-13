<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        return [
            'product_name' => 'required | max:10' ,
            'company_name' => 'required | max:10',
            'price' => 'required | max:3',
            'stock' => 'required | max:3',
        ];

        
    }
    public function money()
    {
        $remain = function($attribute, $value, $fail) {
            $input_data = $this->all();
            if ($input_data['money'] - $input_data['price'] <= 0)
            {
                $fail('【金額】お金が足りないでござる。');
            }
        };

    }

}
