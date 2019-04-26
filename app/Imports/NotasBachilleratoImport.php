<?php

namespace App\Imports;

use App\Notas;
use Maatwebsite\Excel\Concerns\ToModel;

class NotasBachilleratoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Notas([
            //
        ]);
    }
}
