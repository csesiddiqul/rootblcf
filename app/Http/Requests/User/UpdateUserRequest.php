<?php

namespace App\Http\Requests\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\User
 */
class UpdateUserRequest extends FormRequest
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
        $id = $this->get('id');
        $student_code = $this->route('student_code');
        $student = User::where('student_code', $student_code)->first();
        if (empty($student)) {
            abort('404');
        }
        $school_id = $student->school_id;
        $rules = [
            'email' => 'required|email|max:255|unique:users,email,' . $id . ',id,school_id,' . $school_id,
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string'
        ];
        if ($this->get('user_role') == 'teacher') {
            $rules['department_id'] = 'required|numeric';
        }
        if ($this->get('user_role') == 'student') {
            $rules['session'] = 'required|numeric';
            $rules['version'] = 'nullable|string';
            $rules['birthday'] = 'required|string';
            $rules['religion'] = 'required|string';
            $rules['father_name'] = 'required|string';
            $rules['mother_name'] = 'required|string';
        }
        return $rules;
    }
}
