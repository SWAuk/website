<?php

class Artx_Log
{
    function info($msg)
    {
        $bt = debug_backtrace();
        $caller = $bt[1];
        $prefix = '';
        if (isset($caller['class']))
            $prefix .= $caller['class'] . '::';
        $prefix .= $caller['function'] . '(...) - ';
        $writer = & Artx_Log::_getWriter();
        $writer->write($prefix . $msg);
    }

    function trace()
    {
        $formatter = & Artx_Log::_getFormatter();
        $bt = debug_backtrace();
        $caller = $bt[1];
        $msg = '';
        if (isset($caller['class']))
            $msg .= $caller['class'] . '::';
        $msg .= $caller['function'] . '(' . $formatter->args($caller['args']) . ')';
        $writer = & Artx_Log::_getWriter();
        $writer->write($msg);
    }

    function & _getWriter()
    {
        if (!isset($GLOBALS['artx_log_default_writer'])) {
            Artx::load('Artx_Log_ErrorLogWriter');
            $GLOBALS['artx_log_default_writer'] = new Artx_Log_ErrorLogWriter();
        }
        return $GLOBALS['artx_log_default_writer'];
    }

    function & _getFormatter()
    {
        if (!isset($GLOBALS['artx_log_default_formatter'])) {
            Artx::load('Artx_Log_Formatter');
            $GLOBALS['artx_log_default_formatter'] = new Artx_Log_Formatter();
        }
        return $GLOBALS['artx_log_default_formatter'];
    }
}
