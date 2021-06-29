#!/usr/bin/php
<?php

use lib\widgets\Window;
use lib\events\Events;
include 'lib/widgets/colors/Colors.php';
spl_autoload_register(function($className) {
    include __DIR__ . '/' . str_replace('\\','/',$className)  . '.php';
});
include 'lib/widgets/Cadre.php';
$handle = opendir('./radio_direct');
$text = array();
while( false != ($entry = readdir($handle))){
    if ( '.m3u' === substr($entry,-4)){
        array_push($text,substr($entry,0,-4));
    }
}

$w = new Window([
    'border' => DOUBLE_BORDER,
    'color' => LWHITE + BBLUE,
    'inner' => 'TextZone',
    'strip' => LWHITE +BBLACK,
    'selection' => LYELLOW + BRED,
    'cursor'       => 'hide',
    'text' => $text
]
);

function execute($class){
    $sel = $class->get_selected_line();
    $file ="/home/moi/radio_direct/$sel.m3u";
    $cmd = "xterm -fg white -bg black -e /usr/bin/mplayer -playlist $file &";
    system($cmd);
}

$w->draw();
$t = $w->get_objinner();

$e = new Events(
    [
    KEY_PG_DOWN => [$t , 'next_page'],
    KEY_PG_UP   => [$t , 'prec_page'],
    KEY_DOWN   => [$t,'next_selection'],
    KEY_UP    => [$t,'prev_selection'],
    KEY_ENTER   => ['execute',[$t]],
    'exit' => KEY_F10,
    ]
);
$e->endEvent();
$t->show_cursor();
