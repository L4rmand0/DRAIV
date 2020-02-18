<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use DB;

class NotToday implements Rule
{
    private $table;
    private $key_value;
    private $deleted;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($key_value, $table, $deleted = FALSE)
    {
        $this->key_value = $key_value;
        $this->table = $table;
        $this->deleted = $deleted;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $result = $this->getLastDate();
        echo '<pre> last_date';
        print_r($result);
        die;
        if (!empty($result)) {
            return $result->operation == 'D';
        } else {
            return TRUE;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }

    private function getLastDate()
    {
        $operator = $this->deleted == false ? '!=' : '=';
        print_r($this->key_value);
        // $r = DB::table($this->table)
        return DB::table($this->table)
            ->select(DB::raw(
                $this->table.'.start_date'
            ))
            ->where($this->key_value[0], '=',$this->key_value[1])
            ->where($this->table.'.operation',$operator,'D')
            ->orderBy($this->table.'.start_date','desc')
            // ->first();
            ->toSql();
            
    }
}
