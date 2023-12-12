<?php

namespace Master;

class Menu
{
    public function topMenu()
    {
        $base = "http://localhost/absensi/myappupdate/index.php?target=";
        $data = [
            array('text' => 'Home', 'link' => $base . 'home'),
            array('text' => 'absensi', 'link' => $base . 'absensi'),
            array('text' => 'TPI', 'link' => $base . 'tpi'),
            array('text' => 'more', 'link' => $base . 'more')
        ];
        return $data;
    }
}
