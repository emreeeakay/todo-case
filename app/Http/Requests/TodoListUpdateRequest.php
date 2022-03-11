<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoListUpdateRequest extends FormRequest {
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'id'          => 'required|exists:App\Models\TodoList,id',
            'title'       => 'required|max:255',
            'description' => 'required',
        ];
    }
}
