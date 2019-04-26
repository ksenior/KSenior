<?php

namespace App\Imports;

use App\Matricula;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MatriculasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Matricula([
            'ano' => $row['ano'],
            'curso' => $row['curso'],
            'codide' => $row['numerodoc'],
            'codmatricula' => $row['codmatricula'],
            'jornada' => $row['jornada']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
