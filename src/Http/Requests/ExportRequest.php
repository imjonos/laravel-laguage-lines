<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ExportRequest
 * @package Nos\CRUD
 */
class ExportRequest extends FormRequest
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
