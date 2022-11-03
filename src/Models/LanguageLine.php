<?php

namespace Nos\LanguageLine\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Nos\CRUD\Traits\Crudable;
use Spatie\TranslationLoader\LanguageLine as SpatieModel;

/**
 * @property int $id
 * @property string $group
 * @property string $key
 * @property string $text
 *
 * @method Builder ofGroup(string $group)
 * @method Builder ofKey(string $key)
 */
final class LanguageLine extends SpatieModel
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
        'text'
    ];

    protected $fillable = [
        'group',
        'key',
        'text'
    ];

    protected $hidden = [];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * Get language lines table columns
     */
    public function getTableColumns(): array
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

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
     * Scope for filtering by group
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfGroup(Builder $query, string $value): Builder
    {
        return $query->where('group', 'like', "%" . $value . "%");
    }

    /**
     * Scope for filtering by key
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfKey(Builder $query, string $value): Builder
    {
        return $query->where('key', 'like', "%" . $value . "%");
    }

    /**
     * Scope for filtering by text
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfText(Builder $query, string $value): Builder
    {
        return $query->where('text', 'like', "%" . $value . "%");
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
