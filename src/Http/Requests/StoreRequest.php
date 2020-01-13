<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace CodersStudio\LanguageLine\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

/**
 * Class StoreRequest
 * @package CodersStudio\CRUD
 */
class StoreRequest extends FormRequest
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
            'group' => 'required|string',
            'key' => 'required|string',
            'text' => 'required|array',
        ];
    }
}
