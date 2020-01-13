<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace CodersStudio\Languageline\Models;

use Spatie\TranslationLoader\LanguageLine as SpatieModel;
use CodersStudio\CRUD\Traits\Crudable;

class LanguageLine extends SpatieModel
{
    use Crudable;

    /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
                            'id',
                            'group',
                            'key',
                            'text',
    ];

    protected $fillable = [
                            'group',
                            'key',
                            'text',
    ];

    protected $hidden = [];


    /**
     * Get language lines table columns
     */
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    /**
     * Scope for filtering results
     * @param $query
     * @param $val
     * @return mixed
     */
    public function scopeOfOrderColumn($query,$val)
    {
        return $query->orderBy($val,request()->get('order_direction', 'ASC'));
    }

    /**
     * Scope for filtering by id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfId($query,$value)
    {
        return $query->where('id','=',$value);
    }

    /**
     * Scope for filtering by group
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfGroup($query,$value)
    {
        return $query->where('group','like', "%".$value."%");
    }

    /**
     * Scope for filtering by key
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKey($query,$value)
    {
        return $query->where('key','like', "%".$value."%");
    }

    /**
     * Scope for filtering by text
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfText($query,$value)
    {
        return $query->where('text','like', "%".$value."%");
    }
}
