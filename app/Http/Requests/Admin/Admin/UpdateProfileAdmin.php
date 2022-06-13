<?php

namespace App\Http\Requests\Admin\Admin;

use App\Rules\CheckOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileAdmin extends FormRequest
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
            'name'          => ['required', 'string', 'max:50'],
            // 'email'         => [
            //     'required',
            //     'email',
            //     Rule::unique('admins', 'email')->ignore(auth('admin')->user()->id)
            //     ],
            'email' => 'required|email|unique:admins,email,'.auth('admin')->user()->id,
            'old_password'      => ['nullable', 'required_with:password',new CheckOldPassword],
            'password'      => ['nullable', 'string', 'min:4', 'confirmed'],
        ];
    }

    public function attributes()
    {
        $attributes = [
            'name' => __('site.name'),
            'old_password' => __('site.old_password'),
        ];

        return $attributes;
    }
}
