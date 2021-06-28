#!/usr/bin/php
<?php

use lib\widgets\Window;
use lib\events\Events;
use lib\widgets\Msgbox;
include 'lib/widgets/colors/Colors.php';
spl_autoload_register(function($className) {
    include __DIR__ . '/' . str_replace('\\','/',$className)  . '.php';
});
include 'lib/widgets/Cadre.php';
$handle = opendir('/home/moi/radio_direct');
$text = array();
while( false != ($entry = readdir($handle))){
    if ( '.m3u' === substr($entry,-4)){
        array_push($text,substr($entry,0,-4));
    }
}

$m  = new Msgbox([
    'x' => 30, 'y' => 20,
    'width' => 45, 'height' => 10,
    'border' => DOUBLE_BORDER,
    'color' => LWHITE + BBLUE,
    'cursor' => 'hide',
    'inner' => [ 'color' => LWHITE+BRED , 'motif' => MEDIUM_SHADE ],
    'message' => ['Attention : toutes les portes sont ouvertes.', LYELLOW+BGREEN]
]
);


$m->draw();
sleep(5);
$m->show_cursor();
