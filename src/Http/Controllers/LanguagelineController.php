<?php

namespace Nos\LanguageLine\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Nos\CRUD\Traits\{Exportable, Importable};
use Nos\LanguageLine\Exports\LanguageLinesExport;
use Nos\LanguageLine\Http\Requests\{CreateRequest,
    DestroyRequest,
    EditRequest,
    IndexRequest,
    MassDestroyRequest,
    ShowRequest,
    StoreRequest,
    ToggleBooleanRequest,
    UpdateRequest
};
use Nos\LanguageLine\Imports\LanguageLinesImport;
use Nos\LanguageLine\Models\LanguageLine;
use Nos\Languageline\Services\LanguageService;

/**
 * Class CRUDController
 * @package Nos\CRUD\Http\Controllers
 */
class LanguagelineController extends Controller
{

    use Exportable;
    use Importable;

    private LanguageService $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * From trait for import export
     * @return LanguageLinesExport
     */
    public function getExportObject(): LanguageLinesExport
    {
        return new LanguageLinesExport();
    }

    /**
     * From trait for import export
     * @return LanguageLinesImport
     */
    public function getImportObject(): LanguageLinesImport
    {
        return new LanguageLinesImport();
    }

    /**
     * List of records
     * @param IndexRequest $request
     * @return Factory|View|JsonResponse
     */
    public function index(IndexRequest $request): Factory|View|JsonResponse
    {
        $fields = ['id', 'group', 'key', 'text',];
        $model = new LanguageLine();
        $data = $model->search($fields);
        $data = $data->paginate($request->get('per_page', 10));

        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }

        return view("nos.languageline::admin.languagelines.index", ["data" => $data]);
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function store(StoreRequest $request): JsonResponse|Redirector|RedirectResponse
    {
        $newItem = LanguageLine::create($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], '201');
        }

        return redirect('/languagelines');
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return Factory|View
     * @throws BindingResolutionException
     */
    public function create(CreateRequest $request): Factory|View
    {
        return view("nos.languageline::admin.languagelines.create", ['languages' => $this->getDirsWithLanguages()]);
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param LanguageLine $languageline
     * @return Factory|View
     * @throws BindingResolutionException
     */
    public function show(ShowRequest $request, LanguageLine $languageline): Factory|View
    {
        return view("nos.languageline::admin.languagelines.show", [
            'data' => $languageline,
            'languages' => $this->getDirsWithLanguages()
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param int $languageline
     * @return Factory|View
     * @throws BindingResolutionException
     */
    public function edit(EditRequest $request, int $languageline): Factory|View
    {
        $data = LanguageLine::findOrFail($languageline);

        return view("nos.languageline::admin.languagelines.edit", [
            'data' => $data,
            'languages' => $this->getDirsWithLanguages()
        ]);
    }

    /**
     * @param DestroyRequest $request
     * @param LanguageLine $languageline
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(
        DestroyRequest $request,
        LanguageLine $languageline
    ): JsonResponse|Redirector|RedirectResponse {
        $languageline->delete();
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect('/languagelines');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse|Redirector|RedirectResponse
    {
        $forDestroy = LanguageLine::whereIn('id', $request->get('selected'))->get();
        foreach ($forDestroy as $item) {
            $item->delete();
        }
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return redirect('/languagelines');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param LanguageLine $languageline
     * @return JsonResponse
     */
    public function toggleBoolean(ToggleBooleanRequest $request, LanguageLine $languageline): JsonResponse
    {
        if (!in_array($request->get('column_name'), $languageline->getTableColumns()) ||
            $languageline->getKeyType($request->get('column_name')) != 'int') {
            abort(400, 'Wrong column!');
        }
        $languageline->update([$request->get('column_name') => $request->get('value')]);

        return response()->json(['data' => $languageline]);
    }

    /**
     * Update row
     * @param UpdateRequest $request
     * @param LanguageLine $languageline
     * @return JsonResponse|RedirectResponse|Redirector
     */
    public function update(UpdateRequest $request, LanguageLine $languageline): JsonResponse|Redirector|RedirectResponse
    {
        $languageline->update($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $languageline]);
        }

        return redirect('/languagelines');
    }

    /**
     * Scan Translations
     * @return JsonResponse
     */
    public function scanTranslations(): JsonResponse
    {
        $this->storeLanguagesVarsToDB();

        return response()->json([], "204");
    }

    /**
     * Get Array with languages name and path
     * @return array ['language_name' => directory_path]
     * @throws BindingResolutionException
     * @throws Exception
     */
    protected function getDirsWithLanguages(): array
    {
        $result = [];
        $fs = new Filesystem();
        $dirs = $fs->directories(base_path("resources/lang"));
        foreach ($dirs as $dir) {
            $lang = basename($dir);
            if ($lang != "vendor") {
                $result[$lang] = $dir;

                // save a language to DB if doesnt exists
                $result = $this->languageService->search(['abbr' => $lang]);

                if (!$result->count()) {
                    $this->languageService->create([
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
     * Scan languages directory and copy translations to DB
     */
    protected function storeLanguagesVarsToDB(): void
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
     * Get the translations array and save it to DB
     * @param string $group
     * @param string $lang
     * @param array $keys
     * @param array $array
     */
    protected function saveLanguageValueToDB(
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
                $languageLine = LanguageLine::where('group', $group)->where('key', $keyString)->first();

                if (!$languageLine) {
                    LanguageLine::create([
                        'group' => $group,
                        'key' => $keyString,
                        'text' => $translationsArray,
                    ]);
                } else {
                    $translationsArrayMerged = array_merge($languageLine->text, $translationsArray);
                    $languageLine->text = $translationsArrayMerged;
                    $languageLine->save();
                }
            }
        }
    }
}
