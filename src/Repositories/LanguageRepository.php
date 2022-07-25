<?php

namespace Nos\LanguageLine\Repositories;

use Nos\CRUD\Repositories\BaseRepository;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;

final class LanguageRepository extends BaseRepository implements LanguageRepositoryInterface
{
    protected string $class = '';

    public function __construct()
    {
        $this->class = config('languageline.LanguageModel');
    }
}
