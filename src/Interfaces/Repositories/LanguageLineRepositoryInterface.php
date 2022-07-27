<?php

namespace Nos\LanguageLine\Interfaces\Repositories;

use Nos\BaseRepository\Interfaces\EloquentRepositoryInterface;
use Nos\LanguageLine\Models\LanguageLine;

interface LanguageLineRepositoryInterface extends EloquentRepositoryInterface
{
    public function findByGroupAndKey(string $key, string $group): ?LanguageLine;
}
