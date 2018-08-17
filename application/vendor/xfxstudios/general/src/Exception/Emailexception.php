<?php

namespace xfxstudios\Exception;

class Emailexception extends \Exception
{
    public function __construct($message = null, $code = 0)
    {
        parent::__construct($message, $code);
    }
}