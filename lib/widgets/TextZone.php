<?php
namespace lib\widgets;
use lib\widgets\colors\Colors;
use lib\widgets\Screen;
use lib\widgets\Shape;

/**
 * Class TextZone
 * @author yourname
 */
class TextZone extends Shape
{
    private $text_list;
    private $linepos = 0;
    private $obc;
    private $control_remaining_lines = 4;
    private $strip_color = null;
    private $strip_follow = false;
    private $select_bar = null;
    private $select_pos;
    private $select_indice;
    private $last_hpos;
    
    function __construct(array $p =[],Screen $screen = null){
        assert(array_key_exists('text',$p) == true); 
        if ( array_key_exists('text',$p)) {
            $this->text_list = $p{'text'};
        }
        parent::__construct($p,$screen);
        $this->obc = $this->get_objcolor();
        if (array_key_exists('strip',$p)){
            $this->strip_color = $p['strip'];
        }
        if (array_key_exists('strip_follow',$p)){
            $this->strip_follow = $p['strip_follow'];
        }
        if (array_key_exists('selection',$p)){
            $this->select_bar = $p['selection']; 
            $this->select_pos = 1;
            $this->select_indice = 0;
        }

    }

    public function draw(){

        $str = ''; 
        $str .= $this->obc->start_color($this->color_attr); 

        $pos=$this->linepos;
        $i=0;
        $n = null;
        if ($this->strip_follow === true)
            $n = &$pos;
        else
            $n = &$i;

        for (;$i<$this->height && $pos < count($this->text_list);$i++,$pos++){
            $str.= $this->sgotoxy($this->xpos,$this->ypos+$i);
            $this->obj_prescreen->gotoxy($this->xpos,$this->ypos+$i);
            $color=$this->color_attr;
            if ( $this->strip_color != null){
                if ( ($n % 2) == 0){
                    $str .= $this->obc->start_color($this->strip_color);
                    $color = $this->strip_color;
                 } else {
                    $str .= $this->obc->start_color($this->color_attr);
                    $color = $this->color_attr;
                 }
            }

            $text = $this->text_list[$pos];
            $reste = $this->width - mb_strlen($text); 
            if ($reste < 0)
                $reste = 0;
            $spcs = str_repeat(' ',$reste);
            $line = ($text . $spcs);
            $attr = $this->obc->color2_attr($color);
            $this->obj_prescreen->cprint($line,$attr);
            $str .= $line;
        }
        //Completion for out of bounds indices
        for(;$i<$this->height;$i++,$pos++){
            $color = $this->color_attr;
            $str.= $this->sgotoxy($this->xpos,$this->ypos+$i);
                if ( ($n % 2) == 0){
                    $str .= $this->obc->start_color($this->strip_color);
                    $color = $this->strip_color;
                } else {
                    $str .= $this->obc->start_color($this->color_attr);
                    $color = $this->color_attr;
                }
            $line = str_repeat(' ',$this->width);

            $str .= $line; 
            $attr = $this->obc->color2_attr($color);
            $this->obj_prescreen->cprint($line, $attr);
        }
        //Autofixing select bar position        
        if (! is_null($this->select_bar)){
            $h_pos = ($this->select_indice - $this->linepos) + 1;
            if ($h_pos < 1){
                $this->select_indice += (abs($h_pos) + $this->last_hpos);
                $h_pos = $this->last_hpos;
            } else  if ($h_pos > $this->height){
                $this->select_indice -= (($h_pos - $this->height) + ($this->height - $this->last_hpos));
                $h_pos = $this->last_hpos;
            }
            //adding select bar
            $str .= $this->sgotoxy($this->xpos, $h_pos + ($this->ypos - 1 ));
            $text = $this->text_list[$this->select_indice];
            $reste = $this->width - mb_strlen($text); 
            $str .= $this->obc->start_color($this->select_bar);
            $spcs = str_repeat(' ',$reste);
            $tout = ($text . $spcs);
            $str  .= $tout;
            $attr = $this->obc->color2_attr($this->select_bar);
            $this->obj_prescreen->cprint($tout,$attr);
            $this->last_hpos = $h_pos;
        }
        $this->obc->start_color(0); 
        echo $str . "\e[0m";
        return true;
    } 

    public function set_strip(int $strip){
        $this->strip_color = $strip;
    }

    public function set_control_remaining_lines(int $n){
        $this->control_remaining_lines = $n;
    }
    public function next_line(){
       
        if ($this->strip_follow == true){
            if ( ($this->control_remaining_lines + $this->linepos) < count($this->text_list)){
                $this->linepos++;
                return $this->draw();
            }
        }
        return true;
    }

    public function prec_line(){
        if ($this->strip_follow == true ){
            if ($this->linepos >= 1)
                $this->linepos--;
            else
                $this->linepos = 0;
            return $this->draw();
        }
        return true;
    }

    public function next_page(){
        if ( ($this->height + $this->linepos) < count($this->text_list)){
            $this->linepos+=$this->height;
            return $this->draw();
        }
        return true;
    }

    public function prec_page(){
        if (($this->linepos - $this->height) < 0) {
            $this->linepos = 0;
        } else {
            $this->linepos -= $this->height;
        }
            
        return $this->draw();
    }

    public function next_selection() {
        if (($this->select_indice + 1 ) < count($this->text_list))
            $this->select_indice ++;
        if ($this->select_indice  >= ($this->linepos + $this->height))
            $this->next_page();
        return $this->draw();
    }
    public function prev_selection(){
        if ($this->select_indice > 0)
            $this->select_indice --;
        if ($this->select_indice < $this->linepos)
            $this->prec_page();

        return $this->draw();
    }

    public function get_selected_index(){
        return $this->select_indice;
    }
    public function get_selected_line(){
        return $this->text_list[$this->select_indice];
    }
    public function hide(){
    }
}
