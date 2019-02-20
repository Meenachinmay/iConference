<?php


namespace App\Inspection;
use Exception;

class InvalidKeyWords
{

    protected  $keywords = [
        'yahoo customer support'
    ];

    public function detect($body)
    {
        foreach($this->keywords as $keyword){

            if (stripos($body, $keyword) != false){
                throw new Exception('Your reply contains spam words, please make it correct!');
            }
        }
    }

}