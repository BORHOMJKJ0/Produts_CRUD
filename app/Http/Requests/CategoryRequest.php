<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:191|unique:categories,name',
            'description' => 'required|string|max:300|unique:categories,description',
        ];
    }
}
