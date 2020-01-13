<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace CodersStudio\LanguageLine\Exports;

use Maatwebsite\Excel\Concerns\{FromCollection, Exportable};
use CodersStudio\LanguageLine\Models\LanguageLine;

class LanguageLinesExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return LanguageLine::all();
    }
}
