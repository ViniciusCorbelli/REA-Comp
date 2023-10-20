<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'username' => 'required|max:20',
                    'password' => 'required|confirmed|min:8',
                    'email' => 'required|max:191|email|unique:users',
                    'phone_number'=>'max:13',
                    'userProfile.street' => 'max:255',
                    'userProfile.number' => 'max:255',
                    'userProfile.additional_info' => 'max:255',
                    'userProfile.neighborhood' => 'max:255',
                    'userProfile.state' => 'max:255',
                    'userProfile.city' => 'max:255',
                    'userProfile.country' => 'max:255',
                    'userProfile.zipcode' => 'max:255',

                ];
                break;
            case 'patch':
                $rules = [
                    'first_name' => 'required|max:255',
                    'last_name' => 'required|max:255',
                    'username' => 'required|max:20',
                    'email' => 'required|max:191|email|unique:users,email,'.$user_id,
                    'phone_number'=>'max:13',
                    'password' => 'confirmed|min:8|nullable',
                    'userProfile.street' => 'max:255',
                    'userProfile.number' => 'max:255',
                    'userProfile.additional_info' => 'max:255',
                    'userProfile.neighborhood' => 'max:255',
                    'userProfile.state' => 'max:255',
                    'userProfile.city' => 'max:255',
                    'userProfile.country' => 'max:255',
                    'userProfile.zipcode' => 'max:255',
                ];
                break;

        }

        return $rules;
    }

    public function messages() {
        return [];
    }

     /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator){
        $data = [
            'status' => true,
            'message' => $validator->errors()->first(),
            'all_message' =>  $validator->errors()
        ];

        if ($this->ajax()) {
            throw new HttpResponseException(response()->json($data,422));
        } else {
            throw new HttpResponseException(redirect()->back()->withInput()->with('errors', $validator->errors()));
        }
    }


}
