<?php

namespace Nos\LanguageLine\Services;

use Nos\CRUD\Services\BaseService;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;

final class LanguageService extends BaseService
{
    protected string $repositoryClass = LanguageRepositoryInterface::class;
}
