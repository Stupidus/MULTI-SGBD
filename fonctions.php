<?php    function get_include_contents($filename)     {        if (is_file($filename)) {            ob_start();            include $filename;            return ob_get_clean();        }        return false;    }        function checkVar($vars)    {        foreach($vars as $var)        {            if(!isset($var) || empty($var))                return false;        }    }?>