<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateMenuRequest extends FormRequest
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
        $id = \Request::route('menu')->id ?? null;
        return [
            'name' => 'required|string',
            'status' => 'required|numeric',
            'parent' => 'nullable|numeric',
            'priority' => 'nullable|numeric',
            'slug' => 'nullable|string|unique:menus,slug,' . $id . ',id,school_id,' . $school_id . ',type,2',
            'url' => 'required|numeric'
        ];
    }
}
