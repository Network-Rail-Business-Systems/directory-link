<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Exceptions;

use ErrorException;

class NotInDirectoryException extends ErrorException
{
    public function report(): null
    {
        return null;
    }
}
