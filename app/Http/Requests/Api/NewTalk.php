<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class NewTalk extends FormRequest
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
            'title'      => ['required', 'string', 'max:100'],
            'abstract'     => ['required', 'string', 'max:1000'],
            'speaker_id'   => ['required', 'exists:users,id'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'title' => __('site.title'),
            'abstract' => __('site.abstract'),
            'speaker_id' => __('site.speaker'),
        ];

        return $attributes;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'    => false,
            'code'      => 422,
            'message'   => $validator->errors()->first(),
        ]));
    }
}
