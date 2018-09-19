<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class FilmValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|string|unique',
            'description'  => 'required|string',
            'release_date' => 'required|date',
            'rating'       => 'required|min:1|max:5',
            'ticket_price' => 'required|integer',
            'country'      => 'required|string',
            'photo'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'success' => false,
            'message' => $validator->errors(),
        ], 422);
        throw new ValidationException($validator, $response);
    }
}
