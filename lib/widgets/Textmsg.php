<?php


namespace lib\widgets;

/**
 * Class Textmsg
 * @author Jean-Yves Daniel
 */
class Textmsg Extends Shape
{
    private $params;
    /**
     * @param $params
     */
    public function __construct($params)
    {
        $this->params = $params;
    }
    
}
