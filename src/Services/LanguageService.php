<?php

namespace Nos\LanguageLine\Services;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Nos\CRUD\Services\BaseService;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;

/**
 * @method LanguageRepositoryInterface getRepository()
 */
final class LanguageService extends BaseService
{
    protected string $repositoryClass = LanguageRepositoryInterface::class;

    /**
     * @throws BindingResolutionException
     */
    public function getActiveLanguages(): Collection
    {
        return $this->getRepository()->query()->active()->get();
    }
}
