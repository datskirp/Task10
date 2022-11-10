<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type' => 'string|required|max:255',
            'deadline' => 'integer|required',
            'cost' => 'numeric|required',
            'category' => 'string|required|max:255',
        ];
    }
}
