<?php

class ErrorMSG
{
    private $err;
    function _construct($error_message)
    {
        $this->err = $error_message;
    }
    function sendErr()
    {
        
        return json_encode(["error" => $this->err]);
    }
}
?>