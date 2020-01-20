<?php 

namespace App\Traits;

use App\VendorDraiv\ListDatatableUser;

trait TListDataTable {

    public function ListDT(){
        return new ListDatatableUser();
    }
}