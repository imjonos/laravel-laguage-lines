<?php

namespace Nos\LanguageLine\Exports;

use Maatwebsite\Excel\Concerns\{Exportable, FromCollection};
use Nos\LanguageLine\Models\LanguageLine;

class LanguageLinesExport implements FromCollection
{
    use Exportable;

    public function collection()
    {
        return LanguageLine::all();
    }
}
