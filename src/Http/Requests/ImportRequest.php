<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImportRequest
 * @package Nos\CRUD
 */
class ImportRequest extends FormRequest
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
