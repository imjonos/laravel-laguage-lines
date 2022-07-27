<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 * @package Nos\CRUD
 */
final class StoreRequest extends FormRequest
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
            'group' => 'required|string',
            'key' => 'required|string',
            'text' => 'required|array',
        ];
    }
}
