<?php

namespace Nos\LanguageLine\Services;

use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Filesystem\Filesystem;
use Nos\CRUD\Services\BaseService;
use Nos\LanguageLine\Interfaces\Repositories\LanguageLineRepositoryInterface;
use Nos\LanguageLine\Interfaces\Repositories\LanguageRepositoryInterface;

/**
 * @method LanguageLineRepositoryInterface getRepository()
 */
final class LanguageLineService extends BaseService
{
    protected string $repositoryClass = LanguageLineRepositoryInterface::class;
    private LanguageRepositoryInterface $languageRepository;

    public function __construct(LanguageRepositoryInterface $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    /**
     * Scan languages directory and copy translations to DB
     *
     * @throws BindingResolutionException
     */
    public function storeLanguagesVarsToDB(): void
    {
        foreach ($this->getDirsWithLanguages() as $lang => $dir) {
            $fs = new Filesystem();
            $files = $fs->files($dir);
            foreach ($files as $fileName) {
                $filePath = $dir . "/" . $fileName->getRelativePathname();
                $array = (file_exists($filePath)) ? require($filePath) : [];
                $this->saveLanguageValueToDB(basename($fileName->getRelativePathname(), ".php"), $lang, [], $array);
            }
        }
    }

    /**
     * Get Array with languages name and path
     *
     * @return array ['language_name' => directory_path]
     * @throws Exception
     */
    public function getDirsWithLanguages(): array
    {
        $result = [];
        $fs = new Filesystem();
        $dirs = $fs->directories(base_path("resources/lang"));
        foreach ($dirs as $dir) {
            $lang = basename($dir);
            if ($lang != "vendor") {
                $result[$lang] = $dir;

                // save a language to DB if doesnt exists
                $result = $this->languageRepository->findByAbbr($lang);

                if (!$result) {
                    $this->languageRepository->create([
                        'abbr' => $lang,
                        'name' => $lang,
                        'active' => 1
                    ]);
                }
            }
        }

        return $result;
    }

    /**
     * Get the translations array and save it to DB
     *
     * @param string $group
     * @param string $lang
     * @param array $keys
     * @param array $array
     * @throws BindingResolutionException
     */
    public function saveLanguageValueToDB(
        string $group = "crud",
        string $lang = "en",
        array $keys = [],
        array $array = []
    ): void {
        foreach ($array as $key => $item) {
            $keysForDB = $keys;
            $keysForDB[] = $key;
            if (is_array($item)) {
                $this->saveLanguageValueToDB($group, $lang, $keysForDB, $item);
            } else {
                $translationsArray[$lang] = $item;
                $keyString = implode(".", $keysForDB);
                $languageLine = $this->getRepository()->findByGroupAndKey($group, $keyString);

                if (!$languageLine) {
                    $this->getRepository()->create([
                        'group' => $group,
                        'key' => $keyString,
                        'text' => $translationsArray,
                    ]);
                } else {
                    $this->getRepository()->update(
                        $languageLine->id,
                        [
                            'text' => array_merge($languageLine->text, $translationsArray)
                        ]
                    );
                }
            }
        }
    }
}
