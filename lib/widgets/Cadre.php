<?php
namespace lib\widgets; 
use lib\widgets\colors\Colors;
use lib\widgets\Shape;
use lib\widgets\Screen;

define('SIMPLE_BORDER',0);
define('DOUBLE_BORDER',1);
define('SMOOTH_BORDER',2);
define('THICK_SIMPLE_BORDER',3);



class Cadre extends Shape 
{
    private $border;
    private $b_sequences = 
        [
            [ LIGHT_DOWN_AND_RIGHT,
            LIGHT_HORIZONTAL,
            LIGHT_DOWN_AND_LEFT,
            LIGHT_VERTICAL,
            LIGHT_UP_AND_RIGHT,
            LIGHT_UP_AND_LEFT],
            [ DOUBLE_DOWN_AND_RIGHT,
            DOUBLE_HORIZONTAL,
            DOUBLE_DOWN_AND_LEFT,
            DOUBLE_VERTICAL,
            DOUBLE_UP_AND_RIGHT,
            DOUBLE_UP_AND_LEFT],
            [ LIGHT_ARC_DOWN_AND_RIGHT,
            LIGHT_HORIZONTAL,
            LIGHT_ARC_DOWN_AND_LEFT,
            LIGHT_VERTICAL,
            LIGHT_ARC_UP_AND_RIGHT,
            LIGHT_ARC_UP_AND_LEFT],
            [ HEAVY_DOWN_AND_RIGHT,
            HEAVY_HORIZONTAL,
            HEAVY_DOWN_AND_LEFT,
            HEAVY_VERTICAL,
            HEAVY_UP_AND_RIGHT,
            HEAVY_UP_AND_LEFT],
            
        ];

    function __construct( array $p = [],Screen $screen = null)
    {
        if (array_key_exists('border',$p)){
            $this->border = $p['border'];
        }
        parent::__construct($p,$screen);
    }
    public function draw()
    {
        $this->region = $this->obj_prescreen->save_cadre($this->xpos,$this->ypos,$this->width,$this->height);
        $str='';

        $str .= $this->sgotoxy($this->xpos,$this->ypos);
        $this->obj_prescreen->gotoxy($this->xpos,$this->ypos);
        if (! is_null($this->color_attr)){
           $str .= $this->obj_color->start_color($this->color_attr);
        }
        $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][0],$this->color_attr);

        $str .= mb_chr($this->b_sequences[$this->border][0]);

        for($k=1 ;$k<($this->width - 1);$k++){
            $str .=  mb_chr($this->b_sequences[$this->border][1]);
            $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][1] ,$this->color_attr );
        }
        $str .=  mb_chr($this->b_sequences[$this->border][2]);
        $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][2],$this->color_attr);


        for ($i=1;$i<$this->height - 1;$i++){

            $str.= $this->sgotoxy($this->xpos,$this->ypos+$i);
            $this->obj_prescreen->gotoxy($this->xpos,$this->ypos+$i); 


            $str .= mb_chr($this->b_sequences[$this->border][3]);
            $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][3],$this->color_attr);


            $str.= $this->smv_right($this->width - 2);
            $this->obj_prescreen->mv_right($this->width - 2);


            $str .= mb_chr($this->b_sequences[$this->border][3]);
            $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][3],$this->color_attr);
        }

        $str.= $this->sgotoxy($this->xpos,$this->ypos+$i);
        $this->obj_prescreen->gotoxy($this->xpos,$this->ypos+$i);

        $str .= mb_chr($this->b_sequences[$this->border][4]);

        $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][4],$this->color_attr);
        for($k=1 ;$k<($this->width - 1);$k++){
            $str .=  mb_chr($this->b_sequences[$this->border][1]);
            $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][1],$this->color_attr);
        }
        $str .= mb_chr($this->b_sequences[$this->border][5]);


        $this->obj_prescreen->wchar_print($this->b_sequences[$this->border][5],$this->color_attr);
        
        $str .= $this->obj_color->start_color(WHITE);
        echo $str . "\e[0m";

    }

}



