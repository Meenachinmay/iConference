<?php

namespace App\Inspection;
use Exception;
class KeyHeldDown
{

    public function detect($body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)){
            throw new Exception('Your reply contains spam words, please make it correct!');
        }
    }
}