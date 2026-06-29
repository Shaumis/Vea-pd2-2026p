<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        'name' => 'required|min:3|max:256', 
        'voicebank_id' => 'required', 
        'description' => 'nullable', 
        'price' => 'nullable|numeric', 
        'year' => 'numeric', 'image' => 'nullable|image', 
        'images' => 'nullable',];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */

}
