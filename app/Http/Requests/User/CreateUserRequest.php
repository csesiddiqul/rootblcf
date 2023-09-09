<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateUserRequest
 * @package App\Http\Requests\User
 */
class CreateUserRequest extends FormRequest
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
            'email' => 'nullable|email|max:255|unique:users,email,null,id,school_id,' . $school_id,
            'password' => 'nullable|string|min:6|confirmed',
            'section' => 'required|numeric',
            'gender' => 'nullable|string',
            'blood_group' => 'nullable|string',
            'nationality' => 'nullable|string',
            'father_name' => 'nullable|string',
            'mother_name' => 'nullable|string',
            'phone_number' => 'nullable|string|unique:users,phone_number,null,id,school_id,' . $school_id,
            'address' => 'nullable|string',
            'session' => 'required',
            'version' => 'nullable',
            'birthday' => 'required',
            'religion' => 'nullable|string',
            'coursegroup_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        $cName = school('country')->code == 'BD' ? 'Subjects' : 'Courses';
        return [
            'coursegroup_id.required' => 'The ' . $cName . ' Group field is required',
        ];
    }
}
