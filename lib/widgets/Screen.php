<?php

namespace lib\widgets;
use lib\widgets\colors\Colors;
use lib\widgets\PreScreen;

/**
 * Class Screen
 * @author yourname
 */
define('TIOCGWINSZ',0x5413);
define('TEXT_MODE' , array(0,"\017",'('));
define('GRAPH_MODE' , array(1,"\016",')'));
define('TABLE_MODES',[
    1 => 'B',
    2 => '0',
    3 => 'U',
    4 => 'K']);

class Screen
{
    const ESC="\033";
    const CSI ="\233";
    private $lines;
    private $cols;
    private $x_start = 1;
    private $y_start = 1;
    private $method ;
    private $mode = 0;
    private $table;
    private $obj_prescreen;
    

    public function __construct(array $params = null )
    {
        if ($params != null){
            if (array_key_exists('mode',$params)) 
                $this->set_mode($params['mode']);
            else 
                $this->set_mode(TEXT_MODE);

            if (array_key_exists('table',$params)) {
                $this->set_table($params['table']);
                $this->activate();
            }
            else if (array_key_exists('auto',$params)) {
                if ($params['auto'] == 1){
                    $this->table_autoset();
                    $this->activate();
                }
            }
        }
        if ($params == null or ! array_key_exists('lines',$params)  or !array_key_exists('cols',$params))
                $this->line_columns();
        else {
            if ( array_key_exists('lines',$params)) {
                $this->lines = $params['lines'];
                $this->method = 'SET';
            }
            if ( array_key_exists('cols',$params)) {
                $this->cols = $params['cols'];
                $this->method = 'SET';
            }
        }
          $this->obj_prescreen = new PreScreen($this->lines,$this->cols);
    }


    /**
     * undocumented function
     *
     * @return void
     */
    private function line_columns()
    {
         $this->lines = getenv('LINES');
         $this->cols  = getenv('COLUMNS');
         if ($this->lines == null or $this->cols == null)
         {
             $this->lines = exec('tput lines');
             $this->cols  = exec('tput cols');
             $this->method = 'TPUT';
         }else {
              $this->method = 'ENV';
         }
         
         if ($this->lines == null or $this->cols == null)
         {
             dl("ioctl.so");#Charge cette extension
             $f = fopen('/dev/stdout', 'r');
             $struct = str_repeat("\x00", 4);
             $res = ioctl($f,TIOCGWINSZ,$struct,1);
             $a = unpack('slines/scols',$struct);
             fclose($f);
             $this->lines = $a['lines'];
             $this->cols   = $a['cols'];
             $this->method = 'IOCTL';
         }
    }
    public function set_mode( array $mode,int $auto=0) {
        $this->mode = $mode[0];
        switch($mode)
        {
        case TEXT_MODE: echo TEXT_MODE[1];
        break;

        case GRAPH_MODE: echo GRAPH_MODE[1];
        break;

        default: 
        printf("Mauvais mode %d\n",$mode); 
        }
        if ($auto == 1){
            $this->table_autoset();
            $this->activate(); 
        }
    }
    public function set_table(int $table){
        $this->table = $table;
    }

    public function activate() {
        $par='';
        switch ($this->mode)
        {
        case 0 :
            $par = TEXT_MODE[2];
            break;
        case 1 :
            $par = GRAPH_MODE[2];
            break;
        default:
            printf("Mode interdit\n");
        }
        echo ESC . $par .  TABLE_MODES[$this->table];
    }
    
    public function table_autoset() {
        $term = getenv('TERM',true) ?: getenv('TERM');
        if ($term != null) {
            if ($this->mode == 0)
                $this->table = 1;
            else if ($term == 'ansi' or $term == 'linux')
                $this->table = 3;
            else 
                $this->table = 2;
        } else {
              if ($this->mode == 0)
                 $this->table = 1; 
              else 
                 $this->table = 2;
        }
    }

    public function get_lines_cols() {
        return [$this->lines,$this->cols];
    }
    public function get_lines(): int {
        return $this->lines;
    }
    public function get_cols(): int {
        return $this->cols;
    }
    public function get_method(){
        return $this->method;
    }
    public function get_mode(): int {
        return $this->mode;
    }
    public function get_table() : int
    {
        return $this->table;
    }

    public function get_objprescreen() : PreScreen
    {
        return $this->obj_prescreen;
    } 
}
