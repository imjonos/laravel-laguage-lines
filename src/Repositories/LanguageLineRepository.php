<?php

namespace Nos\LanguageLine\Repositories;

use Nos\CRUD\Repositories\BaseRepository;
use Nos\LanguageLine\Interfaces\Repositories\LanguageLineRepositoryInterface;
use Nos\LanguageLine\Models\LanguageLine;

/**
 * @method LanguageLine getModel()
 */
final class LanguageLineRepository extends BaseRepository implements LanguageLineRepositoryInterface
{
    protected string $class = LanguageLine::class;

    public function findByGroupAndKey(string $key, string $group): ?LanguageLine
    {
        return $this->getModel()
            ->ofKey($key)
            ->ofGroup($group)
            ->first();
    }
}
