<?php

namespace Nos\Languageline\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Nos\CRUD\Traits\Crudable;

/**
 * @property int $id
 * @property string $abbr
 * @property string $locale
 * @property string $name
 * @property bool $active
 *
 * @method Builder ofAbbr(string $value)
 * @method Builder active()
 */
final class Language extends Model
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
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeOfId(Builder $query, int $value): Builder
    {
        return $query->where('id', '=', $value);
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
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfLocale(Builder $query, string $value): Builder
    {
        return $query->where('locale', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by name
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfName(Builder $query, string $value): Builder
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Scope for filtering by active
     * @param Builder $query
     * @param int $value
     * @return Builder
     */
    public function scopeOfActive(Builder $query, int $value): Builder
    {
        return $query->where('active', '=', $value);
    }

    /**
     * Scope for filtering by active
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', '=', 1);
    }
}
