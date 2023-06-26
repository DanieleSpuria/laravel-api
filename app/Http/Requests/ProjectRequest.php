<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'title' => 'required | max:255',
            'date' => 'required',
            'description' => 'required | max:2000'
        ];
    }

    public  function messages()
    {
      return [
          'title.required' => 'Title is a required field',
          'title.max' => 'You can enter up to :max characters',
          'date.required' => 'Date is a required field',
          'description.required' => 'Description is a required field',
          'description.max' => 'You can enter up to :max characters',
      ];

    }
}
