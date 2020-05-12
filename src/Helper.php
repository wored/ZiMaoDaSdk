<?php

namespace Wored\ZiMaoDaSdk;


class Helper
{
    static public function dump($param)
    {
        echo '<pre>';
        var_dump($param);
        echo '</pre>';
    }

    static public function dd($param)
    {
        self::dump($param);
        exit;
    }
}