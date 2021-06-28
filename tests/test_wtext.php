#!/usr/bin/php
<?php

use lib\widgets\colors\Colors;
use lib\widgets\Screen;
use lib\widgets\Shape;
use lib\widgets\Rectangle;
use lib\widgets\Cadre;
use lib\widgets\Window;
use lib\widgets\TextZone;

include 'lib/widgets/colors/Colors.php';
spl_autoload_register(function($className) {
    include __DIR__ . '/' . str_replace('\\','/',$className)  . '.php';
});

include 'lib/widgets/Cadre.php';

$filename = '/home/moi/txt/pk2cmd.txt';

$fd = fopen($filename,"r");

$text = array();

if ($fd){
    $line='';
    $contents = fread($fd,filesize($filename));
    $text = explode("\n",$contents);
}

$t = new TextZone([
    'x' => 18,
    'y' => 14,
    'width' => 80,
    'height' => 30,
    'text' => &$text,
    'color' => LWHITE + BBLUE 
]
);

$t->draw();

sleep(5);
$t->next_line();
sleep(5);
$t->next_page();
sleep(2);



