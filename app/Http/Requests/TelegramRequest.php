<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TelegramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * tes
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
            'channel' => 'required|min:5',
            'rss' => ['required','url'],
            'channel' => ['required','url'],
        ];
    }
}
