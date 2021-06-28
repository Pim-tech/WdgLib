<?php

namespace lib\widgets;
use lib\widgets\colors\Colors;
use lib\widgets\Screen;
use lib\widgets\Shape;


/**
 * Class Rectangle
 */
class Rectangle extends Shape
{
    private $motif;

    function __construct( array $p = [],Screen $screen = null)
    {
        if (array_key_exists('motif',$p)){
            $this->motif = $p['motif'];
        }
        parent::__construct($p,$screen);
    }

    public function draw(){
        
        $this->region = $this->obj_prescreen->save_region($this->xpos,$this->ypos,$this->width,$this->height);

        
        $str = '';
        $blocline = '';
        $s = '';
        if (! is_null($this->color_attr)){
            $blocline.= $this->obj_color->start_color($this->color_attr);
        }
        if ($this->motif != null){
            for ($i = 0 ;$i<$this->width;$i++){
                $blocline .= mb_chr($this->motif);
                $s   .= mb_chr($this->motif);
            }
        }
        $attr = $this->color_attr;
        for ($y = 0;$y < $this->height;$y++){
            $this->obj_prescreen->gotoxy($this->xpos,$this->ypos+$y);
            $this->obj_prescreen->cprint($s,$attr);
            $str .= ( $this->sgotoxy($this->xpos,$this->ypos+$y) .$blocline);
        }

        if (! $this->color_attr == null){
            $str.=$this->obj_color->start_color(WHITE);
        }
        echo $str . "\e[0m";
    }
}
