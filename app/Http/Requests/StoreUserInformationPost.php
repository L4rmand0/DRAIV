<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserInformationPost extends FormRequest
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
            'First_name' => 'required|max:255',
            'F_last_name' => 'required|max:255',
            'E_mail_address' => 'required|max:255',
            'Gender' => 'required|max:255',
            'Education' => 'required|max:255',
            'Country_born' => 'required|max:255',
            'Civil_state' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:255'
        ];
    }
}
