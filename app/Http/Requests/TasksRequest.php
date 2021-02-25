<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TasksRequest extends FormRequest
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
        switch($this->method())
        {
            case 'POST': {
                return [
                    'title' => 'required|string|max:100|unique:tasks',
                    'description' => 'string|max:255',
                    'deadline' => 'required|date',
                ];
            }
            case 'PATCH': {
                return [
                    'title' => 'required|string|max:100|unique:tasks,title,'.$this->get('id'),
                    'deadline' => 'required|date',
                    'description' => 'string|max:255',
                ];
            }
            default: {
                return [];
            }
        }  
    }
}
