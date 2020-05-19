<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreLan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return arrays
     */
    public function rules()
    {
        return [
            'nom' => 'required|max:255',
            'info' => 'required|max:5000',
            'max' => 'required|integer|min:0|max:10000',
            'date' => ['required', 'date_format:"Y-m-d\TH:i"'],
            'image' => 'nullable|image'
        ];
    }
}
