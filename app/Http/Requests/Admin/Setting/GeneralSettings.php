<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettings extends FormRequest
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
            'logo'  => 'sometimes|nullable|image|mimes:jpeg,jpg,png,gif',
            'fav_icon'  => 'sometimes|nullable|image|mimes:jpeg,jpg,png,gif',
            'name'  =>  'required|string|max:100',
            'email'  => ['sometimes','nullable',  'email', 'max:191'],
            'phone'  => ['nullable', 'string',  'regex:/(01)[0-9]{9}/'],
            'keywords'  => 'nullable|string|max:10000',
            'about_us' => 'nullable|string|max:3000',
            'description' =>'nullable|string|max:3000',
        ];

        // foreach(config('translatable.locales') as $locale){
        //     $rules[$locale.'.name'] = 'required|string|max:100';
        //     $rules[$locale.'.description'] = 'required|string|max:3000';
        //     $rules[$locale.'.about_us'] = 'required|string|max:3000';
        //     $rules[$locale.'.conditions'] = 'required|string|max:3000';
        //     $rules[$locale.'.privacy_policy'] = 'required|string|max:3000';
        // }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [

            'logo' => __('site.logo'),
            'fav_icon' => __('site.fav_icon'),
            'name' => __('site.name'),
            'email' => __('site.address'),
            'twitter' => __('site.twitter'),
            'phone' => __('site.phone'),
            'keywords'  => __('site.keywords'),
            'about_us'  => __('site.about_us'),
            'description'  => __('site.description'),
        ];

        // foreach(config('translatable.locales') as $locale){
        //     $attributes[$locale.'.name'] = __('site.name_'.$locale);
        //     $attributes[$locale.'.description'] = __('site.description_'.$locale);
        //     $attributes[$locale.'.about_us'] = __('site.about_us_'.$locale);
        //     $attributes[$locale.'.conditions'] = __('site.conditions_'.$locale);
        //     $attributes[$locale.'.privacy_policy'] = __('site.privacy_policy_'.$locale);
        // }

        return $attributes;
    }
}
