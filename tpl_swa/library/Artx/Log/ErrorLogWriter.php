<?php

class Artx_Log_ErrorLogWriter
{
    function write($msg)
    {
        error_log($msg);
    }
}