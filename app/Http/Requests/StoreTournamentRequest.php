<?php

namespace App\Http\Requests;

use App\Challonge;
use App\Lan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTournamentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Lan::find($this->lan)->user_id == Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lan' => 'exists:App\Lan,id',
            'nom' =>  'required|string',
            'key' => 'required',
            'type' => Rule::in(array_column(Challonge::TYPES, 'value'))
        ];
    }
}
