<?php

namespace App\Imports;

use App\Disciplina;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DisciplinaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Disciplina([
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
