<?php

namespace App\Imports;

use App\Models\UserAge;
//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\{Importable, ToModel, WithHeadingRow};

class UsersAgeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserAge([
            'name'     => $row['name'],
            'age'    => $row['age'], 
        ]);
    }
}
