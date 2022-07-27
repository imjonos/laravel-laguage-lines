<?php

namespace Nos\LanguageLine\Repositories;

use Nos\CRUD\Repositories\BaseRepository;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;
use Nos\LanguageLine\Models\Language;

/**
 * @method Language getModel()
 */
final class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    protected string $class = Language::class;

    public function findByAbbr(string $abbr): ?Language
    {
        return $this->getModel()->ofAbbr($abbr)->first();
    }
}
