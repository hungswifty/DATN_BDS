<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoginPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        //cho phep validate data => true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // tao ra cac rules rang buoc du lieu(validate data)
            // user va pass chinh la name cua the input do  
            'user' => 'required|min:3|max:60',
            'pass' => 'required|min:3|max:60' 
        ];
    }
    // Tao ham thong bao 
    public function messages(){
        return [
            //user, pass chinh la name cua tag do
            //attribute chinh la tag dang chon
            'user.required' => ':attribute khong duoc de trong',
            'user.min' => ':attribute khong duoc nho hon :min ki tu',
            'user.max' => ':attribute khong duoc lon hon :max ki tu',
            'pass.required' => ':attribute khong duoc de trong',
            'pass.min' => ':attribute khong duoc nho hon :min ki tu',
            'pass.max' => ':attribute khong duoc lon hon :max ki tu'
        ];
    }
}
