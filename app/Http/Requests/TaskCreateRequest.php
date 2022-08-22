<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'nullable|min:5',
            'status' => 'required|string',
            'image' => 'nullable|image'
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'title.required'  => 'Please give a title',
            'status.required' => 'Please give a status',
            'image.image'     => 'Please give a valid image'
        ];
    }
}
