<?php

namespace Nos\Languageline\Services;

use Nos\CRUD\Services\BaseService;
use Nos\LanguageLine\Repositories\LanguageRepository;

final class LanguageService extends BaseService
{
    protected string $repositoryClass = LanguageRepository::class;
}
