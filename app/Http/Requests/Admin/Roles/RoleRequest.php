<?php

namespace App\Http\Requests\Admin\Roles;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        switch ($this->method()){
            case 'POST': {
                return [
                    'name' => 'required|unique:roles',
                    'permissions' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':{
                return [
                    'name' => 'required|unique:roles,name,'.$this->id,
                    'permissions' => 'required',
                ];
            }

            default:
            break;
        }



        // $rules = [
        //     'name' => 'required|unique:roles',
        //     'permissions' => 'required',
        // ];

        // if (in_array($this->method(), ['PUT', 'PATCH'])) {

        //     $role = $this->route()->parameter('role');

        //     $rules['name'] = 'required|unique:roles,name,' . $role->id;

        // }//end of if

        // return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => __('site.name'),
            'permissions' => __('site.permissions'),
        ];

        // foreach(config('translatable.locales') as $locale){
        //     $attributes[$locale.'.name'] = __('site.name_'.$locale);
        // }

        return $attributes;
    }
}
