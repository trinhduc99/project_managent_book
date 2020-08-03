<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|unique:categories|min:5|max:255',
            'parent_id' =>'required'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.unique' => 'The name field is unique',
            'name.max' => 'The name can\'t be more 255 characters',
            'name.min' => 'The name can\'t be less 10 characters',
            'parent_id.required' => 'Category Parent is required',
        ];
    }
}
