<?php

namespace App\Http\Requests;

use App\Utils\Traits\HelperTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateCampaign extends FormRequest
{
    use HelperTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|max:250",
            "from_date" => "required|date_format:Y-m-d",
            "to_date" => "required|date_format:Y-m-d",
            "total_budget" => "required|numeric",
            "daily_budget" => "required|numeric",
            "creatives" => "required|array",
            "creatives.*" => "mimes:jpg,jpeg,png"
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'creatives.*.required' => 'Please upload an image',
            'creatives.*.mimes' => 'Only jpg, jpeg and png images are allowed.'
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param Validator $validator
     * @return void
     *
     * @author "Md. Abdullah-Al-Mamun" <mamuncse824@gmail.com>
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            new JsonResponse(
                $this->responseData(
                    false,
                    422,
                    "Create Campaign request failed.",
                    $validator->errors()
                ),
                422
            )
        );
    }
}
