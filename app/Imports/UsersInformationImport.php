<?php

namespace App\Imports;

use App\DriverInformation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

// HeadingRowFormatter::default('none');

class UsersInformationImport implements ToModel, WithStartRow
{
    private $id_company;
    private $id_user;

    public function __construct($variables = false) {
        if($variables !== false){
            $this->id_company = $variables['company_id'];
            $this->id_user = $variables['id'];
        }    
    }
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

        return new DriverInformation([
            'dni_id' => $row[0],
            'first_name' => $row[1],
            'second_name' => $row[2],
            'f_last_name' => $row[3],
            's_last_name' => $row[4],
            'gender' => $row[5],
            'education' => $row[6],
            'e_mail_address' => $row[7],
            'address' => $row[8],
            'country_born' => $row[9],
            'phone' => $row[10],
            'civil_state' => $row[11],
            'db_user_id' => $row[12],
            'company_id' => $row[13],
            'db_user_id' => $this->id_user,
            'company_id' => $this->id_company
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
