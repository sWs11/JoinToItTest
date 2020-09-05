<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class SaveCompany extends FormRequest
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
            'name' => 'required|string',
            'email' => 'nullable|email',
            'website' => 'nullable|string',
            'logo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                'dimensions:min_width=100,min_height=100',
                /*function ($attribute, $value, $fail) {

                    if ($value instanceof UploadedFile) {
                        $image_info = getimagesize($value->getPathname());
                        if ($image_info[0] < 100 || $image_info[1] < 100) {
                            $fail(__('main.logo') . ' must be minimum 100×100.');
                        }
                    }
                }*/
            ]
        ];
    }
}
