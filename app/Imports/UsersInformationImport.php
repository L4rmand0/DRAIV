<?php

namespace App\Imports;

use App\UserInformation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

// HeadingRowFormatter::default('none');

class UsersInformationImport implements ToModel, WithStartRow
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

        return new UserInformation([
            'DNI_id' => $row[0],
            'First_name' => $row[1],
            'Second_name' => $row[2],
            'F_last_name' => $row[3],
            'S_last_name' => $row[4],
            'Gender' => $row[5],
            'Education' => $row[6],
            'E_mail_address' => $row[7],
            'address' => $row[8],
            'Country_born' => $row[9],
            'phone' => $row[10],
            'Civil_state' => $row[11],
            'Db_user_id' => $row[12],
            'Company_id' => $row[13]
        ]);
        // return new UserInformation([
        //     'DNI_id' => $row['DNI_id'],
        //     'First_name' => $row['First_name'],
        //     'Second_name' => $row['Second_name'],
        //     'F_last_name' => $row['F_last_name'],
        //     'S_last_name' => $row['S_last_name'],
        //     'Gender' => $row['Gender'],
        //     'Education' => $row['Education'],
        //     'E_mail_address' => $row['E_mail_address'],
        //     'address' => $row['address'],
        //     'Country_born' => $row['Country_born'],
        //     'phone' => $row['phone'],
        //     'Civil_state' => $row['Civil_state'],
        //     'Db_user_id' => $row['Db_user_id'],
        //     'Company_id' => $row['Company_id']
        // ]);

    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
