<?php
/**
 * CodersStudio 2019
 *  https://coders.studio
 *  info@coders.studio
 */

namespace CodersStudio\LanguageLine\Http\Controllers;

use App\Http\Controllers\Controller;
use CodersStudio\LanguageLine\Http\Requests\{
    IndexRequest,
    CreateRequest,
    EditRequest,
    ShowRequest,
    StoreRequest,
    UpdateRequest,
    DestroyRequest,
    MassDestroyRequest,
    ToggleBooleanRequest
};

use Illuminate\Filesystem\Filesystem;
use CodersStudio\CRUD\Traits\{Importable, Exportable};
use CodersStudio\LanguageLine\Exports\LanguageLinesExport;
use CodersStudio\LanguageLine\Imports\LanguageLinesImport;
use CodersStudio\LocalesSwitcher\Language;
use CodersStudio\LanguageLine\Models\LanguageLine;

/**
 * Class CRUDController
 * @package CodersStudio\CRUD\Http\Controllers
 */
class LanguagelineController extends Controller
{

    use Importable, Exportable;

    /**
     * From trait for import export
     * @return LanguageLinesExport
     */
    public function getExportObject()
    {
        return new LanguageLinesExport();
    }

    /**
     * From trait for import export
     * @return LanguageLinesImport
     */
    public function getImportObject()
    {
        return new LanguageLinesImport();
    }

    /**
     * List of records
     * @param IndexRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(IndexRequest $request)
    {
        $fields = ['id','group','key','text',];
        $model = new LanguageLine();
        $data = $model->search($fields);
        $data = $data->paginate($request->get('per_page', 10));

        if ($request->ajax()) {
            return response()->json(['data' => $data]);
        }

        return view("codersstudio.languageline::admin.languagelines.index", ["data" => $data]);
    }


    /**
     * Create form
     * @param CreateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(CreateRequest $request)
    {
        return view("codersstudio.languageline::admin.languagelines.create", ['languages' => $this->getDirsWithLanguages()]);
    }

    /**
     * Store row
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreRequest $request)
    {
        $newItem = LanguageLine::create($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $newItem], '201');
        }
        return redirect('/languagelines');
    }

    /**
     * Show row
     * @param ShowRequest $request
     * @param LanguageLine $languageline
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(ShowRequest $request, LanguageLine $languageline)
    {
        return view("codersstudio.languageline::admin.languagelines.show", [
            'data' => $languageline,
            'languages' => $this->getDirsWithLanguages()
        ]);
    }

    /**
     * Edit form
     * @param EditRequest $request
     * @param int $languageline
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(EditRequest $request, int $languageline)
    {
        $data = LanguageLine::findOrFail($languageline);
        return view("codersstudio.languageline::admin.languagelines.edit", [
            'data' =>  $data,
            'languages' => $this->getDirsWithLanguages()
        ]);
    }


    /**
     * Update row
     * @param UpdateRequest $request
     * @param LanguageLine $languageline
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRequest $request, LanguageLine $languageline)
    {
        $languageline->update($request->all());
        if ($request->ajax()) {
            return response()->json(['data' => $languageline]);
        }
        return redirect('/languagelines');
    }

    /**
     * @param DestroyRequest $request
     * @param LanguageLine $languageline
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(DestroyRequest $request, LanguageLine $languageline)
    {
        $languageline->delete();
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/languagelines');
    }

    /**
     * Destroy multiple rows
     * @param MassDestroyRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function massDestroy(MassDestroyRequest $request)
    {
        $forDestroy = LanguageLine::whereIn('id',$request->get('selected'))->get();
        foreach ($forDestroy as $item) {
            $item->delete();
        }
        if ($request->ajax()) {
            return response()->json([],204);
        }
        return redirect('/languagelines');
    }

    /**
     * Toggle boolean fields from index table
     * @param ToggleBooleanRequest $request
     * @param LanguageLine $languageline
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleBoolean(ToggleBooleanRequest $request, LanguageLine $languageline)
    {
        if (!in_array($request->get('column_name'), $languageline->getTableColumns()) ||
            $languageline->getKeyType( $request->get('column_name')) != 'int') {
            abort(400,'Wrong column!');
        }
        $languageline->update([$request->get('column_name') => $request->get('value')]);
        return response()->json(['data' => $languageline]);
    }

    /**
     * Scan Translations
     * @return \Illuminate\Http\JsonResponse
     */
    public function scanTranslations()
    {
        $this->storeLanguagesVarsToDB();
        return response()->json([], "204");
    }

    /**
     * Scan languages directory and copy translations to DB
     */
    protected function storeLanguagesVarsToDB():void
    {
        foreach ($this->getDirsWithLanguages() as $lang => $dir) {
            $fs = new Filesystem();
            $files = $fs->files($dir);
            foreach ($files as $fileName) {
                $filePath = $dir."/".$fileName->getRelativePathname();
                $array = (file_exists($filePath))?require($filePath):[];
                $this->saveLanguageValueToDB( basename($fileName->getRelativePathname(), ".php"), $lang, [], $array);
            }
        }
    }

    /**
     * Get Array with languages name and path
     * @return array ['language_name' => directory_path]
     */
    protected function getDirsWithLanguages():array
    {
        $result = [];
        $fs = new Filesystem();
        $dirs = $fs->directories(base_path("resources/lang"));
        foreach ($dirs as $dir) {
            $lang = basename($dir);
            if($lang != "vendor") {
                $result[$lang] = $dir;

                // save a language to DB if doesnt exist
                if(!Language::where('name', $lang)->count()) {
                    $langRecord = new Language(['name' => $lang]);
                    $langRecord->save();
                }
            }
        }
        return $result;
    }

    /**
     * Get the translations array and save it to DB
     * @param string $group
     * @param string $lang
     * @param array $keys
     * @param array $array
     */
    protected function saveLanguageValueToDB(string $group = "crud", string $lang = "en", array $keys = [], array $array = []):void
    {
        foreach ($array as $key => $item) {
            $keysForDB = $keys;
            $keysForDB[] = $key;
            if(is_array($item)) {
                $this->saveLanguageValueToDB($group, $lang, $keysForDB, $item);
            }else {
                $translationsArray[$lang] = $item;
                $keyString = implode(".", $keysForDB);
                $languageLine = LanguageLine::where('group', $group)->where('key', $keyString)->first();

                if(!$languageLine) {
                    LanguageLine::create([
                        'group' => $group,
                        'key' => $keyString,
                        'text' => $translationsArray,
                    ]);
                }else{
                    $translationsArrayMerged = array_merge($languageLine->text, $translationsArray);
                    $languageLine->text = $translationsArrayMerged;
                    $languageLine->save();
                }
            }
        }
    }
}
