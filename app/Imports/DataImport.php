<?php

namespace App\Imports;

use App\Models\Import;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $dataImport = new Import([
            'lga' => $row['lga'],
            'state' => $row['state']
        ]);

        $dataImport['lga'] = str_replace(' ', '', $dataImport['lga']);
        $dataImport['state'] = str_replace(' ', '', $dataImport['state']);

        return $dataImport;
    }
}
