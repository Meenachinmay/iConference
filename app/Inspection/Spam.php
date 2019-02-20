<?php

namespace App\Inspection;

use App\Inspection\InvalidKeyWords;
use App\Inspection\KeyHeldDown;

class Spam
{

    protected $inspections = [
        InvalidKeyWords::class,
        KeyHeldDown::class
    ];

    //
    public function detect($body)
    {

        foreach($this->inspections as $inspection){
            app($inspection)->detect($body);
        }

        return false;
    }

}