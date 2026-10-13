<?php

namespace NetworkRailBusinessSystems\DirectoryLink\Exceptions;

use ErrorException;

class DirectoryLinkException extends ErrorException
{
    public function report(): ?false
    {
        return $this->code === 500
            ? false
            : null;
    }
}
