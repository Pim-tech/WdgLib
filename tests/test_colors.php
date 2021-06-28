#!/usr/bin/php
<?php

use lib\widgets\colors\Colors;
use lib\widgets\Screen;
//use lib\widgets\Shape;
//use lib\widgets\Rectangle;
//use lib\widgets\Cadre;
use lib\widgets\Window;
use lib\events\Events;

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

$w = new Window([
   /*  'x' => 1,
    'y' => 1, 
    'width' => 40,
    'height' => 25,*/
    //'motif'  => 0X2591,
    'border' => DOUBLE_BORDER,
    'color' => LWHITE + BBLUE,
    'inner' => 'TextZone',
    'strip' => LWHITE +BBLACK,
    'selection' => LYELLOW + BRED,
    'cursor'       => 'hide',
    //'strip_follow' => false,

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
    'exit' => KEY_F10,
    KEY_DOWN    => [ $t,'next_line'],
    KEY_PG_DOWN => [$t , 'next_page'],
    KEY_UP      => [$t , 'prec_line'],
    KEY_PG_UP   => [$t , 'prec_page'],
    KEY_RIGHT   => [$t,'next_selection'],
    KEY_LEFT    => [$t,'prev_selection'],
    KEY_ENTER   => ['execute',[$t]]
    ]
);
$e->endEvent();
$t->show_cursor();
/*
$c = new Cadre([
    'x' => 30,
    'y' => 19,
    'width' => 40,
    'height' => 20,
    'border' =>SMOOTH_BORDER,
    'text'   => $text,
    'color' => LWHITE+BBLUE
]
);
 

sleep(20);
$c->draw();
sleep(3);
$c->hide();
*/


