<?php

namespace Nos\LanguageLine\Interfaces\Repositories;

use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;
use Nos\LanguageLine\Models\Language;

interface LanguageRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByAbbr(string $abbr): ?Language;
}
