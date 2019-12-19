<?php

namespace App\Imports;

use App\DrivingLicence;
use Maatwebsite\Excel\Concerns\ToModel;

class DrivingLicenceImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DrivingLicence([
            //
        ]);
    }
}
