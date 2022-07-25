<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace Nos\LanguageLine\Imports;

use Maatwebsite\Excel\Concerns\{ToModel, Importable};
use Nos\LanguageLine\Models\LanguageLine;

class LanguageLinesImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new LanguageLine([
            'id' => $row[0],
            'group' => $row[1],
            'key' => $row[2],
            'text' => json_decode($row[3]),

        ]);
    }
}
