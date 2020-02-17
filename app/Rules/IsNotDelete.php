<?php

namespace App\Rules;
use DB;

use Illuminate\Contracts\Validation\Rule;

class IsNotDelete implements Rule
{
    private $key;
    private $table;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($key_value, $table)
    {
        $this->key = $key_value;
        $this->table = $table;
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
        $result = $this->getOperation();
        return $result->operation == 'D';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El registro tiene que estar eliminado.';
    }

    private function getOperation(){
        return DB::table($this->table)
            ->select(DB::raw(
                $this->table.'.operation'
            ))
            ->where($this->key[0], '=',$this->key[1])
            ->orderBy($this->table.'.start_date','desc')->first();
    }
}
