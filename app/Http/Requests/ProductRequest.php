<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string|min:5|max:255',
            'name_author' => 'required|string|min:5|max:255',
            'feature_image_path' => 'required',
            'category_id' => 'required',
            'contents' => 'required|string|min:10|'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name field is unique',
            'name.max' => 'The name can\'t be more 255 characters',
            'name.min' => 'The name can\'t be less 5 characters',
            'name_author.required' => 'The name field is required.',
            'name_author.unique' => 'The name field is unique',
            'name_author.max' => 'The name can\'t be more 255 characters',
            'name_author.min' => 'The name can\'t be less 5 characters',
            'feature_image_path' => 'Image is required',
            'category_id' => 'Category is required',
            'contents.required' => 'Category Parent is required',
            'contents.min' => 'The name can\'t be less 10 characters',
        ];
    }
}
