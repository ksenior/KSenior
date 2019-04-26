<?php

namespace App\Imports;

use App\Fallas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FallasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Fallas([
            'ano' => $row['ano'],
            'periodo' => $row['periodo'],
            'curso' => $row['curso'],
            'numerodoc' => $row['numerodoc'],
            'castellano' => $row['castellano'],
            'matematica' => $row['matematica'],
            'naturales' => $row['naturales'],
            'sociales' => $row['sociales'],
            'ingles' => $row['ingles'],
            'electivas' => $row['electivas'],
            'comerciales' => $row['comerciales'],
            'disciplina' => $row['disciplina'],
            'optativa' => $row['optativa']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
