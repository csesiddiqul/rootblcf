<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateStaffRequest extends FormRequest
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
        $school_id = Auth::guest() ? school('id') : Auth::user()->school_id;
        return [
            'name' => 'required|string|max:255',
            'email' => 'sometimes|email|max:255|unique:users,email,null,id,school_id,' . $school_id,
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required',
            'blood_group' => 'required',
            'phone_number' => 'required|unique:users,phone_number,null,id,school_id,' . $school_id
        ];
    }
}
