<?php

namespace lib\events;

define('KEY_PG_DOWN','[6~');
define('KEY_PG_UP','[5~');
define('KEY_DOWN','[B');
define('KEY_UP','[A');
define('KEY_RIGHT','[C');
define('KEY_LEFT','[D');
define('KEY_F10','[21');
define('KEY_ENTER',"\n");



class Events
{
    private $method = 'stty';
    private $map = array();
    private $exit_key;
    private $handle;
    private $flip_lines = false;
    private $flip_attr;

    public function __construct( $params = [] )
    {
        assert(array_key_exists('exit',$params));
        if (array_key_exists('method',$params)){
            $this->method = params['method'];
            unset($params['method']);
        }
        if (array_key_exists('exit',$params)){
            $this->exit_key = $params['exit'];
            unset($params['exit']);
        }

        $this->map = $params;
        $this->__init();
        $this->__map();
    }

    private function __init(){
        
        switch($this->method){
        case 'stty' : system("/usr/bin/stty -icanon -echo eol \001");
        break;
        case 'cpio' : 
            break;
        case 'tcgetsetattr':
            break;
        }
    }

    private function __map(){

       $this->handle = fopen("/dev/stdin" , "r");
        while(1)
        {
            $char = fgetc($this->handle);
            if (ord($char[0]) == 0X1B){
                $char='';
                  for ($i=0;$i<2;$i++)
                      $char.= fgetc($this->handle);
                  if ($char[0] == '[') 
                      if ((ord($char[1]) >= 48 && ord($char[1]) <= 57) or $char[1] == '[' )
                          $char .= fgetc($this->handle);
            }
            if ($char == $this->exit_key){
                break;
            }

            if (array_key_exists($char,$this->map)){
                $call = $this->map[$char];
                $callable = [];
                $parameters = array();
                if (gettype($call[0]) == 'string'){
                    $callable = $call[0];
                    $parameters = $call[1];
                } else  if (gettype($call[0]) == 'object') {
                    $callable = [$call[0],$call[1]];
                }

                if (! is_callable($callable)){
                    echo "uncallable action : \n";
                    var_dump($callable);
                    $this->endEvent();
                    return false;
                }
                try {
                    $ok = null;
                    if (count($parameters) > 0){
                        $ok= call_user_func_array($callable,$parameters);
                    } else {
                        $ok =call_user_func($callable);
                    }
                    if ($ok === false) {
                        $this->endEvent();
                        echo "Error Could not run '$var'\n";
                        return false;
                    }
                } catch(Exception $e){
                    $this->endEvent();
                    return 'Error: exception '.get_class($e).', '.$e->getMessage().'.';
                }
            }
        }

    }

    public function endEvent(){
        fclose($this->handle);
        switch($this->method){
        case 'stty' : system("/usr/bin/stty sane");
        break;
        case 'cpio' : 
            break;
        case 'tcgetsetattr':
            break;
        }
    }
}
