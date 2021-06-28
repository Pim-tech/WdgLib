<?php

namespace lib\widgets;

use lib\widgets\colors\Colors;
use lib\widgets\Shape;
use lib\widgets\Screen;
use lib\widgets\PreScreen;
use lib\widgets\Cadre;
use lib\widgets\Rectangle;

/**
 * Class Msgbox
 * @author Jean Yves Daniel
 */

class Msgbox extends Shape
{
    private $params;
    private $obj_rectangle = null;
    private $message,$color_message,$m_xpos,$m_ypos;
    private $obc;
    /**
     * @param $params
     */
    public function __construct($params, Screen $screen = null)
    {
        $this->params = $params;
        if (array_key_exists('inner',$params)){
            $p = $params; 
            if (array_key_exists('x',$params)){
               $p['x'] =  $params['x'] + 1;
            }
            if (array_key_exists('y',$params)){
                $p['y'] =  $params['y'] + 1;
            }
            if (array_key_exists('width',$params)){
                $p['width'] =  $params['width'] - 2;
            }
            if (array_key_exists('height',$params)){
                $p['height'] =  $params['height'] - 2;
            }
            if (array_key_exists('motif',$params['inner'])){
                $p['motif'] = $params['inner']['motif'];
            }
            if (array_key_exists('color',$params['inner'])){
                $p['color'] = $params['inner']['color'];
            }
            if (array_key_exists('message',$params)){
                $this->message = $params['message'][0];
                $this->color_message = $params['message'][1];
                $this->m_ypos = intval($p['height']  / 2 ) + $p['y'];
                $this->m_xpos = intval($p['width'] / 2) + $p['x'] - intval(strlen($this->message) / 2);
            }
            $this->obj_rectangle = new Rectangle($p,$screen);
        }
        parent::__construct($params,$screen);
    }

    public function draw()
    {
        parent::draw();
        if (! is_null($this->obj_rectangle))
            $this->obj_rectangle->draw();
        $str = '';
        if (! is_null($this->message)){
           ;
        }
    }

}
