<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlStoreRequest extends FormRequest
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
        return [
            'redirect_url' => 'required',
            'lifetime' => 'required|after:now',
        ];
    }

    public function messages()
    {
        return [
            'redirect_url.required' => 'Поле "Сссылка" пустое',
            'lifetime.required' => 'Поле "Время жизни" пустое',
            'lifetime.after' => 'Указано неверное время'
        ];
    }
}
