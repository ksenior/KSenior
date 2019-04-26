<?php

namespace App\Imports;

use App\Alumno;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Alumno([
            'docide' => $row['tipo_documento'],
            'numerodoc' => $row['numerodocumento'],
            'primernombre' => $row['primernombre'],
            'segundonombre' => $row['segundonombre'],
            'primerapellido' => $row['primerapellido'],
            'segundoapellido' => $row['segundoapellido'],
            'fechanac' => $row['fecha_nacimiento'],
            'lugarnac' => $row['lugar_nacimiento'],
            'lugarexp' => $row['lugar_expedicion'],
            'direccion' => $row['direccion'],
            'departamento' => $row['departamento'],
            'municipio' => $row['municipio'],
            'barrio' => $row['barrio'],
            'telefono' => $row['telefono'],
            'acudiente' => $row['nombreacudiente'],
            'parentesco' => $row['parentesco'],
            'telefonofami' => $row['telefonoacudiente'],
            'direccionfami' => $row['direccionfamiliar']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
