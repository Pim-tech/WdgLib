<?php

namespace lib\widgets\colors;

define('ESC',"\033");
define('CSI' ,"\233");
define('BLACK',0);
define('RED',1);
define('GREEN',2);
define('BROWN',3);
define('BLUE',4);         #couleurs de bases
define('MAGENTA',5);
define('CYAN',6);
define('WHITE',7);

define('LBLACK',8);
define('LRED',9);
define('LGREEN',10);
define('LYELLOW',11);
define('LBLUE',12);        
define('LMAGENTA',13);        #couleurs claires
define('LCYAN',14); 
define('LWHITE',15);


define('BBLACK',0);         # Les couleurs de fond commencent  a  16
define('BRED',16);
define('BGREEN',32);       
define('BYELLOW',48);        #couleurs de fond
define('BBLUE',64);
define('BMAGENTA',80);
define('BCYAN',96);
define('BWHITE',112);

define('LBBLACK',128);
define('LBRED',144);
define('LBGREEN',160);
define('LBYELLOW',176);
define('LBBLUE',192);
define('LBMAGENTA',208);
define('LBCYAN',224);
define('LBWHITE',240);

define('NOCOLOR',129);

define('BOLD',1);
define('LOW',2);
define('SOUL',4);
define('BLINK',5);      #clignote
define('INVERSE',7);
define('REINIT',10);       
define('NULLC',11);     #needded to display chars to build boxes
define('NULLCCMETA',12);
define('NORMAL1',21);
define('NORMAL2',22);
define('NOSOUL',24);
define('NOBLINK',25);
define('NOINVERSE',27);
define('GRMOD',"\016");

define('ANSI_MAXATTR',0b11111111);
define('ANSI_BGSEP',4);
define('ANSI_CMASK'      ,0b00001111);
define('ANSI_BRIGHT_FLAG',0b00001000);
define('ANSI_COLOR_MASK',0b00000111);

define('COLOR_256_MAXATTR',0b1111111111111111);
define('COLOR_256_CMASK',      0b0000000011111111);
define('COLOR_256_BGSEP',8);

define('TRUECOLOR_MAXATTR' , 0b111111111111111111111111111111111111111111111111);
define('TRUECOLOR_CMASK',    0b000000000000000000000000111111111111111111111111);
define('TRUECOLOR_BGSEP',24);

define('COLOR_ANSI',1);
define('COLOR_256',2);
define('COLOR_TRUECOLOR',3);

define('BASIC_COLORS' ,[
    [0,0,0],
    [128,0,0],
    [0,128,0],
    [128,128,0],
    [0,0,128],
    [128,0,128],
    [0,128,128],
    [192,192,192],
    [128,128,128],
    [225,0,0],
    [0,255,0],
    [255,255,0],
    [0,0,255],
    [255,0,255],
    [0,255,255],
    [255,255,255]]);
#modes 
define('RESET',129);     #This is reset mode : ESC[0m or CSI 0m
/**
 * Class Colors
 * @author yourname
 */
class Colors
{
    /**
     * @param $dependencies
     */
    private $startseq = null;
    private $resetseq = null;
    private $current_attrib = 0;
    private $current_mode   = null;
    private $sequence;

    private $max_attr,$bgsep,$cmask,$bright_flag,$color_masq;
    private $current_colorchar,$current_fond, $color_depth;

    public function __construct( $prefix = 'ESC' )
    {
        if ($prefix === 'ESC'){
            $this->startseq = (ESC . '[');
            $this->resetseq = (ESC . '[0m'); 
        }
        else if ($prefix === 'CSI') {
            $this->startseq = CSI;
            $this->resetseq = (CSI . '0m');
        }
        else {
            $this->startseq = (ESC . '[');
            $this->resetseq = (ESC . '[0m'); 
        }
        $this->set_colordepth(COLOR_ANSI);
    }

    private static function sequence_ascii(&$ar,$bg,$a,$r,$v,$b){array_push($ar,30 + $bg + $a); }
    private static function sequence_256(&$ar,$bg,$a,$r,$v,$b){       array_push($ar,38+$bg,5,$a);} 
    private static function sequence_truecolor(&$ar,$bg,$a,$r,$v,$b){ array_push($ar,38+$bg,2,$r,$v,$b);}

    public function set_colordepth(int $color_depth){
        $this->color_depth = $color_depth;
        switch($color_depth)
        {
        case COLOR_ANSI:
            $this->max_attr = ANSI_MAXATTR;
            $this->bgsep    = ANSI_BGSEP;
            $this->cmask    = ANSI_CMASK;
            $this->bright_flag = ANSI_BRIGHT_FLAG;
            $this->color_masq  = ANSI_COLOR_MASK;
            $this->sequence = 'sequence_ascii';
            break;
        case COLOR_256:
            $this->max_attr = COLOR_256_MAXATTR;
            $this->bgsep    = COLOR_256_BGSEP;
            $this->cmask    = COLOR_256_CMASK;
            $this->sequence = 'sequence_256';
            break;
        case COLOR_TRUECOLOR:
            $this->max_attr = TRUECOLOR_MAXATTR;
            $this->bgsep    = TRUECOLOR_BGSEP;
            $this->cmask    = TRUECOLOR_CMASK;
            $this->sequence = 'sequence_truecolor';
            break;
        default:
        } 
    }
    public function color2_attr($color) : int {

        $attrib = null;
        $bgr=$bgv=$bgb=$fgr=$fgv=$fgb=null;
        if ( gettype($color) == 'integer'){
            if ($this->color_depth == COLOR_TRUECOLOR){
                [$bg,$fg] = [ $color >> $this->bgsep,$color & $this->cmask ];
                if ($fg < 16) {
                    [$fgr,$fgv,$fgb] = BASIC_COLORS[$fg];
                }
                if ($bg < 16){
                    [$bgr,$bgv,$bgb] = BASIC_COLORS[$bg];
                }
                $attrib = $color;
            } else
                $attrib = $color;
        } else if (gettype($color) == 'array'){
            if(array_keys($color) !== range(0, count($color) - 1)) {
                if (key_exists('bg',$color)){
                    if (gettype($color['bg']) == 'integer') 
                        $attrib = ($color['bg'] << $this->bgsep);
                    else if (gettype($color['bg']) == 'array') {
                        [$bgr,$bgv,$bgb] = $color['bg'];
                        $nbg  = ($bgr <<16) + ($bgv << 8) + $bgb;
                        $attrib = ($nbg << $this->bgsep);
                    }
                }
                if (key_exists('fg',$color)){
                    if (gettype($color['fg']) == 'integer') 
                        $attrib |= $color['fg'];
                    else if (gettype($color['fg']) == 'array') {
                        [$fgr,$fgv,$fgb] = $color['fg'];
                        $nfg  = ($fgr <<16) + ($fgv << 8) + $fgb;
                        $attrib |=  $nfg;
                    }
                }
            }
        }

        if ($attrib > $this->max_attr){
            printf("Bad color : must be < %d in this mode.\n",$this->max_attr);
            return -1;
        }
        return $attrib;
    }

    public function start_color($attr,int $mode = null): string {
        $attrib = null;
        $bgr=$bgv=$bgb=$fgr=$fgv=$fgb=null;
        if ( gettype($attr) == 'integer'){
            if ($this->color_depth == COLOR_TRUECOLOR){
                [$bg,$fg] = [ $attr >> $this->bgsep,$attr & $this->cmask ];
                if ($fg < 16) {
                    [$fgr,$fgv,$fgb] = BASIC_COLORS[$fg];
                }
                if ($bg < 16){
                    [$bgr,$bgv,$bgb] = BASIC_COLORS[$bg];
                }
                $attrib = $attr;
            } else
                $attrib = $attr;
        } else if (gettype($attr) == 'array'){
            if(array_keys($attr) !== range(0, count($attr) - 1)) {
                if (key_exists('bg',$attr)){
                    if (gettype($attr['bg']) == 'integer') 
                        $attrib = ($attr['bg'] << $this->bgsep);
                    else if (gettype($attr['bg']) == 'array') {
                        [$bgr,$bgv,$bgb] = $attr['bg'];
                        $nbg  = ($bgr <<16) + ($bgv << 8) + $bgb;
                        $attrib = ($nbg << $this->bgsep);
                    }
                }
                if (key_exists('fg',$attr)){
                    if (gettype($attr['fg']) == 'integer') 
                        $attrib |= $attr['fg'];
                    else if (gettype($attr['fg']) == 'array') {
                        [$fgr,$fgv,$fgb] = $attr['fg'];
                        $nfg  = ($fgr <<16) + ($fgv << 8) + $fgb;
                        $attrib |=  $nfg;
                    }
                }
            }
        }

        if ($attrib > $this->max_attr){
            printf("Bad color : must be < %d in this mode.\n",$this->max_attr);
            return '';
        }

        $s = array();

        //Met le mode à 0 si il est null 
        /*if ($mode != $this->current_mode && $mode == null) {
            array_push($s,0);
            $this->current_attrib = 0;
        }*/ 

        if ( $attrib != $this->current_attrib){
            $fond = ($attrib >> $this->bgsep);
            $color_char = ($attrib & $this->cmask);
            if ($this->color_depth == COLOR_ANSI && ($color_char & $this->bright_flag)) {
                array_push($s,1); 
                $color_char &= $this->color_masq;
            }
            if ($this->current_colorchar !== $color_char){
                $v = $this->sequence;
                $this->$v($s,0,$color_char,$fgr,$fgv,$fgb);

                $this->current_colorchar = $color_char;
            }
            if ($this->color_depth == COLOR_ANSI && ($fond & $this->bright_flag)) {
                #TODO
                printf("\e[0mPas de fond clair dans ce mode! ");
            }
            //if ( $this->current_fond !== $fond){
             $v = $this->sequence;
             $this->$v($s,10,$fond,$bgr,$bgv,$bgb);
             $this->current_fond = $fond;
            //}
            $this->current_attrib = $attrib;
        } 
        if ($mode != $this->current_mode){

            if ($mode > 0){
                array_push($s,$mode);
            }
            else if (! is_null($mode) ) array_push($s,24,25,27);
            $this->current_mode = $mode;
        } 
        if (empty($s)) return '';
        return $this->startseq . implode(';',$s) . 'm';
    }
    public function reset_color() {
        return $this->resetseq;
    }

    public function cprint(string $str,$attrib=null,$mode = null ) {

        if ($attrib == null){
            echo $this->reset_color();
        } else {
            echo $this->start_color($attrib,$mode);
        }
        echo $str;
    }
    public function aprint(string $str,int $fgcolor,int $bgcolor = null, int $mode=null){
            echo $this->start_color($fgcolor + ($bgcolor << $this->bgsep),$mode);
            echo $str;
    }
    public function aprintln(string $str,int $fgcolor,int $bgcolor = null, int $mode=null){
        $this->aprint($str,$fgcolor,$bgcolor,$mode);
        echo "\n";
    }


    public function cprintln(string $str, $attrib = null,int $mode = null) {
        
        $this->cprint($str,$attrib,$mode);
        echo  "\n";
    }


    public function pstart_color($attrib,int $mode = null){
        echo $this->start_color($attrib,$mode);
    }
    public function preset(){
        echo $this->reset_color();
    }

    /**
     *
     */
    public function get_startseq():string
    {
        return $this->startseq;
    }
    


}
