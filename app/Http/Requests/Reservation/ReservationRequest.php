<?php

namespace App\Http\Requests\Reservation;

use App\Http\DTOs\Reservation\ReservationDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class ReservationRequest extends FormRequest
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
            'length' => ['required'],
            'book_id' => ['required', 'unique:reservations'],
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
    public function toDto(): ReservationDto
    {
        return new ReservationDto($this->length, $this->book_id);
    }
}
