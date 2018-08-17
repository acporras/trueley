<?php

namespace xfxstudios\Exception;

class Storageexception extends \Exception
{
    private $options;
    private $msg;

    public function __construct($message = null, $code = 0, $options = array('errorCode'=>'0'))
    {
        parent::__construct($message, $code);
        $this->options = $options;
        $this->msg = $message;
    }

    public function _getOptions(){
        return $this->options;
    }

    public function _getMessage(){
        return $this->msg;
    }
}