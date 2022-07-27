<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ToggleBooleanRequest
 * @package Nos\CRUD
 */
class ToggleBooleanRequest extends FormRequest
{
    /**
     * authorize
     */
    public function authorize()
    {
        return true;
    }

    /**
     * rules
     */
    public function rules()
    {
        return [
        ];
    }
}
