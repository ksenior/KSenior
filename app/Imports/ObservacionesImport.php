<?php

namespace App\Imports;

use App\Observaciones;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ObservacionesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Observaciones([
            'ano' => $row['ano'],
            'numerodoc' => $row['numerodocumento'],
            'periodo' => $row['periodo'],
            'codobservacion' => $row['codobservacion']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
