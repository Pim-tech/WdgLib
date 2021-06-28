#!/usr/bin/php
<?php
use lib\widgets\colors\Colors;
use lib\widgets\Screen;
use lib\widgets\Shape;
use lib\widgets\Rectangle;
use lib\widgets\Cadre;
use lib\widgets\Window;
use lib\widgets\TextZone;
use lib\events\Events;

include 'lib/widgets/colors/Colors.php';

spl_autoload_register(function($className) {
    include __DIR__ . '/' . str_replace('\\','/',$className)  . '.php';
});

include 'lib/widgets/Cadre.php';


$filename = '/home/moi/txt/pk2cmd.txt';

$fd = fopen($filename,"r");
$text = array();

/*$handle = opendir('/home/moi/radio_direct');
$text = array();
while( false != ($entry = readdir($handle))){
    if ( '.m3u' === substr($entry,-4)){
        array_push($text,substr($entry,0,-4));
    }
}*/

if ($fd){
    $line='';
    $contents = fread($fd,filesize($filename));
    $text = explode("\n",$contents);
}

$t = new TextZone([
/*    'x' => 4,
    'y' => 4,
    'width' => 130,
    'height' => 60, */
    'text' => &$text,
    'color_depth' => COLOR_256,
    'color' => ['fg' => 15, 'bg' => 19], 
    'cursor' => 'hide',
    'strip' => ['bg' => 106, 'fg' => 198],
    //'strip_follow' => true, 
    'selection' => ['bg' => 196, 'fg' => 15]
]
);


$t->draw();

$e = new Events(
    [
    'exit' => KEY_F10,
    KEY_DOWN => [ $t,'next_line'],
    KEY_PG_DOWN => [$t , 'next_page'],
    KEY_UP => [$t , 'prec_line'],
    KEY_PG_UP => [$t , 'prec_page'],
    KEY_RIGHT => [$t,'next_selection'],
    KEY_LEFT  => [$t,'prev_selection']
    ]
);
        
$e->endEvent();
$t->show_cursor();
