<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

/**
 * Class CreateTeacherRequest
 * @package App\Http\Requests\User
 */
class CreateTeacherRequest extends FormRequest
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
            'department_id' => 'nullable|numeric',
            'phone_number' => 'required|string'
        ];
    }
}
