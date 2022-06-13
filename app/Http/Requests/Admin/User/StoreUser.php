<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'email'     => 'required|email|unique:users,email',
            'password'  => ['required', 'string', 'min:4', 'confirmed'],
        ];
    }

    public function attributes()
    {
        return [
            // 'parent_id'      => __('site.mainCategory'),
            'slug'      => __('site.slug')
        ];
    }
}
