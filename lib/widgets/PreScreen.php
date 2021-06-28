<?php

namespace lib\widgets;

/**
 * Class PreScreen
 * @author yourname
 */
class PreScreen
{
    private $size;
    private $buffer = array();
    private $pos=0;
    private $lines = null;
    private $cols  = null;
    private $region;

   /**
    * @param $dependencies
    */

   public function __construct(int $lines,int $cols)
   {
        $this->lines = $lines;
        $this->cols  = $cols;
        $this->size = ($lines * $cols );
        $this->_init();
   }
    
    private function _init()
    {
        for($i = 0 ; $i < $this->size; $i++)
            $this->buffer[$i] = [0,0X20];
    }

    public function gotoxy(int $x, int $y)
    {
        assert($x < ($this->cols - 1));
        assert($y < ($this->lines - 1));
        $x--; //Les indices de tableau commencent à 0
        $y--; 
        $this->pos = ($this->cols * $y) + $x;
    }
    public function mv_right($n)
    {
        assert( (($this->pos % $this->cols) + $n) <= $this->cols);
        $this->pos += $n;

    }

    public function cprint(string $str,$attr,int $mode=null)
    {
        $ar = iconv('UTF-8','UCS-4LE',$str);
        $ar2 = unpack('V*',$ar);
        
        $k=$this->pos;
        foreach ($ar2 as $key => $val){
            $this->buffer[$k][0] = $attr;
            $this->buffer[$k++][1] = $val; //$val;
        }
        $this->pos = $k;
    }
    public function wchar_print(int $wchar,int $attr,int $mode=null){
       $k = $this->pos;
            $this->buffer[$k][0] = $attr;
            $this->buffer[$k][1] = $wchar;
            $this->pos++;
    }

    public function getpos(int $x,int $y) : int{
        $_x = $x - 1;
        $_y = $y - 1;
        $pos = ($_y * $this->cols) + $_x;
        return $pos;
    }

    public function save_cadre (int $x,int $y,int $width, int $height)
    {
        $this->gotoxy($x,$y);
        $i=0;
        $this->region = [];
        $this->region[$i++] = array(-$x,-$y);

        for ($n = 0; $n < $width; $n++){
            $this->region[$i++] = $this->buffer[$this->pos++];
        }

        for($h = 1;$h<($height - 1);$h++){
            $this->gotoxy($x,$y+$h);
            $_y = $y + $h;
            $this->region[$i++] = array(-$x,-$_y);
            $this->region[$i++] = $this->buffer[$this->pos];
            $w = $width - 2;
            $this->region[$i++] = array(1000,-$w);
            $this->pos += $w;
            $this->region[$i++] = $this->buffer[$this->pos];
        }

        $_y = $y + $h;
        $this->region[$i++] = array(-$x,-$_y);
        for ($n = 0; $n < $width; $n++){
            $this->region[$i++] =  $this->buffer[$this->pos++];
        }
        return $this->region;
    }

    public function save_region(int $x,int $y,int $width,int $height)
    {
        $i=0;
        $this->region = [];
        for( $h = 0;$h<$height;$h++){
            $this->gotoxy($x,$y+$h);
            $this->region[$i++] = array(-$x,-($y+$h));
            for ($n = 0; $n < $width; $n++){
                $this->region[$i++] = $this->buffer[$this->pos + $n];
            }
        }
        return $this->region;
    }

    public function get_region() : array
    {
        return $this->region;
    }

    public function get_buffer()
    {
        return $this->buffer;
    }
}
