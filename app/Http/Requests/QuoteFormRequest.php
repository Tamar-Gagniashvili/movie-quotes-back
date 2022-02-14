<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuoteFormRequest extends FormRequest
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
        $rules = [
            'text'      => 'required',
            'movie_id'  => ['required', Rule::exists('movies', 'id')],
        ];

        foreach (config('app.available_locales') as $locale) {
            $rules['text.' . $locale] = 'string';
        }

        return $rules;
    }
}
