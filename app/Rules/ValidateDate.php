<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateDate implements Rule
{
    private $fecha_menor;
    private $message;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($fecha_menor,$message = null)
    {
        $this->fecha_menor = $fecha_menor;
        $this->message = $message;
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
        if(strtotime($this->fecha_menor) > strtotime($value)){
            return false;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->message != null){
            return 'La fecha de vencimiento no puede ser menor a la fecha de expedición.';
        }
        return 'La fecha no puede ser mayor';
    }
}
