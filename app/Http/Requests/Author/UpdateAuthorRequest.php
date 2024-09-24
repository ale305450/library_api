<?php

namespace App\Http\Requests\Author;

use App\Http\DTOs\Author\UpdateAuthorDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateAuthorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'bio' => ['required'],
            'image' => ['file', 'mimes:png,jpg'],
        ];
    }

    /**
     * Get the validation errors that may accure in the request.
     *
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ], 400));
    }


    /**
     * Link the DTO with the request.
     *
     */
    public function toDto(): UpdateAuthorDto
    {
        return new UpdateAuthorDto($this->name, $this->bio, $this->image);
    }
}
