<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Nos\CRUD\Traits\Crudable;

/**
 * @method Builder ofAbbr(string $value)
 */
class Language extends Model
{
    use Crudable;

    /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
        'id',
        'abbr',
        'locale',
        'name',
        'active'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'abbr',
        'locale',
        'name',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Scope for filtering by id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfId($query, $value)
    {
        return $query->where('id', '=', $value);
    }

    /**
     * Scope for filtering by id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfAbbrWhere($query, $value)
    {
        return $query->where('abbr', '!=', $value);
    }


    /**
     * Scope for filtering by abbr
     *
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfAbbr(Builder $query, string $value): Builder
    {
        return $query->where('abbr', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by locale
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfLocale($query, $value)
    {
        return $query->where('locale', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfName($query, $value)
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by native
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfNative($query, $value)
    {
        return $query->where('native', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by flag
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfFlag($query, $value)
    {
        return $query->where('flag', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by app_name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfAppName($query, $value)
    {
        return $query->where('app_name', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by script
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfScript($query, $value)
    {
        return $query->where('script', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by direction
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfDirection($query, $value)
    {
        return $query->where('direction', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by russian_pluralization
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfRussianPluralization($query, $value)
    {
        return $query->where('russian_pluralization', '=', $value);
    }


    /**
     * Scope for filtering by active
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfActive($query, $value)
    {
        return $query->where('active', '=', $value);
    }

    /**
     * Scope for filtering by active
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', '=', 1);
    }


    /**
     * Scope for filtering by default
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfDefault($query, $value)
    {
        return $query->where('default', '=', $value);
    }


    /**
     * Scope for filtering by parent_id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfParentId($query, $value)
    {
        return $query->where('parent_id', '=', $value);
    }


    /**
     * Scope for filtering by lft
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfLft($query, $value)
    {
        return $query->where('lft', '=', $value);
    }


    /**
     * Scope for filtering by rgt
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfRgt($query, $value)
    {
        return $query->where('rgt', '=', $value);
    }


    /**
     * Scope for filtering by depth
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfDepth($query, $value)
    {
        return $query->where('depth', '=', $value);
    }


    /**
     * Scope for filtering by keywords_location
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKeywordsLocation($query, $value)
    {
        return $query->where('keywords_location', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by category_name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfCategoryName($query, $value)
    {
        return $query->where('category_name', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by keywords_icon
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKeywordsIcon($query, $value)
    {
        return $query->where('keywords_icon', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by keywords_country
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKeywordsCountry($query, $value)
    {
        return $query->where('keywords_country', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by keywords_city
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKeywordsCity($query, $value)
    {
        return $query->where('keywords_city', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by keywords_job
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfKeywordsJob($query, $value)
    {
        return $query->where('keywords_job', 'like', '%' . $value . '%');
    }


}
