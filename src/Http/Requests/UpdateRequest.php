<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package Nos\CRUD
 */
final class UpdateRequest extends FormRequest
{
    /**
     * authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * rules
     */
    public function rules(): array
    {
        return [
            'group' => 'sometimes|string',
            'key' => 'sometimes|string',
            'text' => 'sometimes|array',
        ];
    }
}
