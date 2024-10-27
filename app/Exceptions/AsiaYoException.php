<?php

namespace App\Exceptions;

use Exception;

class AsiaYoException extends Exception
{
    public function report()
    {
        // do something
    }

    public function render()
    {
        return response()->json($this->getMessage(), 400);
    }
}
