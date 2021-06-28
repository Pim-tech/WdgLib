<?php

namespace lib\widgets;

use lib\widgets\colors\Colors;
use lib\widgets\PreScreen;
use lib\widgets\Screen;
use lib\widgets\Rectangle;
use lib\widgets\Shape;
use lib\widgets\Cadre;
use lib\widgets\TextZone;


/**
 * Class Window
 * @author yourname
 */
class Window
{
    private $obj_cadre = null;
    private $obj_inner;
    private $xpos;
    private $ypos;
    private $width;
    private $height;
    private $color_attr;
    private $border;
    private $motif;
    private $inner;

    public function __construct(array $param = null,Screen $scr = null)
    {
        if (! is_null($param)){
            $className = null;
            assert(array_key_exists('inner',$param));
            if (array_key_exists('inner',$param)){
                $className =  'lib\\widgets\\' . $this->inner = $param['inner'];
                $class = new \ReflectionClass($className);
            }
            if (array_key_exists('no_border',$param)){
                if ($param['no_border'] = true){
                   $this->obj_inner = $class->newInstanceArgs([$param,$scr]); 
                }
            } else {
                $p =  $param;
                $this->obj_cadre = new Cadre($param,$scr);
                if (array_key_exists('x',$param)){
                    $this->xpos = $param['x'];
                    $p['x'] =  $param['x'] + 1;
                }
                if (array_key_exists('y',$param)){
                    $this->ypos = $param['x'];
                    $p['y'] =  $param['y'] + 1;
                }
                if (array_key_exists('width',$param)){
                    $this->width = $param['width'];
                    $p['width'] =  $param['width'] - 2;
                }
                if (array_key_exists('height',$param)){
                    $this->height = $param['height'];
                    $p['height'] =  $param['height'] - 2;
                }
                if (false === array_key_exists('width',$param)){
                    $p['x'] = 2;
                    $this->width = $this->obj_cadre->get_objscreen()->get_cols();
                    $p['width'] = $this->width - 2;
                    $this->xpos = 1;
                }
                if (false === array_key_exists('height',$param)){
                    $p['y'] = 2;
                    $this->height = $this->obj_cadre->get_objscreen()->get_lines();
                    $p['height'] = $this->height - 2;
                    $this->ypos = 1;
                }

                $this->obj_inner = $class->newInstanceArgs([$p,$scr]);
            }

            if (array_key_exists('x',$param)){
                $this->xpos = $param['x'];
            }
            if (array_key_exists('y',$param)){
                $this->ypos = $param['y'];
            }
            if (array_key_exists('height',$param)){
                $this->height = $param['height'];
            }
            if (array_key_exists('width',$param)){
                $this->width = $param['width'];
            }
            if (array_key_exists('color',$param)){
                $this->color_attr = $param['color'];
            }
            if (array_key_exists('border',$param)){
                $this->border = $param['border'];
            }
            if (array_key_exists('motif',$param)){
                $this->motif = $param['motif'];
            }
        }
    }

    public function move($param = []){
            if (array_key_exists('x',$param)){
                $this->xpos = $param['x'];
            }
            if (array_key_exists('y',$param)){
                $this->ypos = $param['y'];
            }
            if (array_key_exists('height',$param)){
                $this->height = $param['height'];
            }
            if (array_key_exists('width',$param)){
                $this->width = $param['width'];
            }
            if (array_key_exists('color',$param)){
                $this->color_attr = $param['color'];
            }
            if (array_key_exists('border',$param)){
                $this->border = $param['border'];
            }
            if (array_key_exists('motif',$param)){
                $this->motif = $param['motif'];
            }


           $this->hide();
           $dim_cadre = array($this->xpos, $this->ypos, $this->width, $this->height);
           $dim_rectangle = array($this->xpos + 1,$this->ypos + 1,$this->width - 2, $this->height - 2);
           $this->obj_inner->set_adimentions($dim_rectangle);
           $this->obj_cadre->set_adimentions($dim_cadre);
           $this->obj_cadre->set_colorattr($this->color_attr);
           $this->obj_inner->set_colorattr($this->color_attr);
           $this->draw();
    }

    public function get_objinner()
    {
        return $this->obj_inner;
    }
    public function set_objinner($obj)
    {
        $this->obj_inner = $obj;
    }

    public function draw()
    {
        $this->obj_cadre->draw();
        $this->obj_inner->draw(); 
    } 
    public function hide(){
        $this->obj_cadre->hide();
        $this->obj_inner->hide();
    }

    public function show_cursor(){
        if (! is_null($this->obj_cadre)){
            $this->obj_cadre->show_cursor();
        }
        else {
            $this->obj_inner->show_cursor();
        }
    }

}
