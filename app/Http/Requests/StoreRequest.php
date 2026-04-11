<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        // لازم يكون مسجل دخول وما عنده متجر مسبقاً
        return Auth::check() && !Auth::user()->store;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:stores,name',
            'description' => 'nullable|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
}
