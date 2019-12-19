<?php

namespace App\Imports;

use App\Vehicle;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VehiclesImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }

        return new Vehicle([
            'Plate_id' => $row[0],
            'Type_V' => $row[1],
            'Owner_V' => $row[2],
            'Taxi_type' => $row[3],
            'taxi_Number_of_drivers' => $row[4],
            'Soat_expi_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
            'Capacity' => $row[6],
            'Service' => $row[7],
            'Cylindrical_cc' => $row[8],
            'V_class' => $row[9],
            'Model' => $row[10],
            'Line' => $row[11],
            'Brand' => $row[12],
            'Color' => $row[13],
            'Platetechnomechanical_date_id' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14]),
            'User_information_DNI_id' => $row[15]
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
