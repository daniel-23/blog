<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'title'        => 'required|string|max:255',
            'categories'   => 'required|array',
            'categories.*' => 'exists:categories,id',
            'content'      => 'required|string',
            'is_public'    => 'required|boolean',
        ];
    }
}
