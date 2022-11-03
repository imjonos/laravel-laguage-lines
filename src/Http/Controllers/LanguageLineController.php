<?php

namespace Nos\LanguageLine\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\Factory;
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
use Nos\LanguageLine\Services\LanguageLineService;
use Nos\LanguageLine\Services\LanguageService;

/**
 * Class CRUDController
 * @package Nos\CRUD\Http\Controllers
 */
class LanguageLineController extends Controller
{

    use Exportable;
    use Importable;

    private LanguageService $languageService;
    private LanguageLineService $languageLineService;

    public function __construct(LanguageService $languageService, LanguageLineService $languageLineService)
    {
        $this->languageService = $languageService;
        $this->languageLineService = $languageLineService;
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
     * @throws BindingResolutionException
     */
    public function index(IndexRequest $request): Factory|View|JsonResponse
    {
        $fields = ['id', 'group', 'key', 'text', 'created_at'];
        $with = [

        ];
        $limit = $request->get('per_page', 10);
        $data = $this->languageLineService->search($request->all(), $fields, $with, $limit);
        $response = [
            'data' => $data,
            'selected' => [
                'id' => $request->get('id'),
                'group' => $request->get('group'),
                'key' => $request->get('key'),
                'text' => $request->get('text')
            ]
        ];
        if ($request->ajax()) {
            return response()->json($response);
        }

        return view('nos.languageline::admin.languagelines.index', $response);
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws Exception
     */
    public function store(StoreRequest $request): JsonResponse|Redirector|RedirectResponse
    {
        $newItem = $this->languageLineService->create($request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], '201');
        }

        return response()->redirectToRoute('languagelines.index');
    }

    /**
     * Create form
     * @param CreateRequest $request
     * @return Factory|View
     * @throws BindingResolutionException|Exception
     */
    public function create(CreateRequest $request): Factory|View
    {
        return view(
            "nos.languageline::admin.languagelines.create",
            [
                'languages' => $this->languageService->all()
            ]
        );
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
            'languages' => $this->languageLineService->getDirsWithLanguages()
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param LanguageLine $languageline
     * @return Factory|View
     * @throws Exception
     */
    public function edit(EditRequest $request, LanguageLine $languageline): Factory|View
    {
        return view("nos.languageline::admin.languagelines.edit", [
            'data' => $languageline,
            'languages' => $this->languageService->all()
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
        $this->languageLineService->delete($languageline->id);
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return response()->redirectToRoute('languagelines.index');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function massDestroy(MassDestroyRequest $request): JsonResponse|Redirector|RedirectResponse
    {
        foreach ($request->get('selected', []) as $id) {
            $this->languageLineService->delete($id);
        }
        if ($request->ajax()) {
            return response()->json([], 204);
        }

        return response()->redirectToRoute('languagelines.index');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param LanguageLine $languageline
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function toggleBoolean(ToggleBooleanRequest $request, LanguageLine $languageline): JsonResponse
    {
        if (!in_array($request->get('column_name'), $languageline->getTableColumns()) ||
            $languageline->getKeyType($request->get('column_name')) !== 'int') {
            abort(400, 'Wrong column!');
        }
        $this->languageLineService->update($languageline->id, [
            $request->get('column_name') => $request->get('value')
        ]);

        return response()->json(['data' => $languageline]);
    }

    /**
     * Update row
     * @param UpdateRequest $request
     * @param LanguageLine $languageline
     * @return JsonResponse|RedirectResponse|Redirector
     * @throws BindingResolutionException
     */
    public function update(UpdateRequest $request, LanguageLine $languageline): JsonResponse|Redirector|RedirectResponse
    {
        $this->languageLineService->update($languageline->id, $request->validated());
        if ($request->ajax()) {
            return response()->json(['data' => $languageline]);
        }

        return response()->redirectToRoute('languagelines.index');
    }

    /**
     * Scan Translations
     * @return JsonResponse
     * @throws BindingResolutionException
     */
    public function scanTranslations(): JsonResponse
    {
        $this->languageLineService->storeLanguagesVarsToDB();

        return response()->json([], "204");
    }
}
