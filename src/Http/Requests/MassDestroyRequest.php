<?php

namespace Nos\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyRequest
 * @package Nos\CRUD
 */
class MassDestroyRequest extends FormRequest
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
            'selected.*' => 'exists:language_lines,id',
        ];
    }
}
