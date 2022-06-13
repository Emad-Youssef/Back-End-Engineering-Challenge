<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmin extends FormRequest
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
            'name'      => ['required', 'string', 'max:50'],
            'email'     => 'required|email|unique:admins,email',
            'password'  => ['required', 'string', 'min:4', 'confirmed'],
            'role_id'   => ['required', 'exists:roles,id'],
        ];
    }
    public function attributes()
    {
        $attributes = [
            'name' => __('site.name'),
            'role_id' => __('site.roles'),
        ];

        return $attributes;
    }
}
