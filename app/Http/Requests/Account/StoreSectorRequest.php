<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSectorRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:account_sectors,name,null,id,school_id,' . Auth::user()->school_id,
            'type' => 'required|string',
            'op_balance' => 'required|numeric',
            'ledger_id' => 'required|numeric',
        ];
    }
}
