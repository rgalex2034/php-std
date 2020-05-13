<?php
namespace ARG\Std;

class StdArray extends Type\Base{

    private $array;

    public function __construct(...$elements){
        $this->array = $elements;
    }

    public static function from($array){
        return self::create(...$array);
    }

    public function original(){
        return $this->array;
    }

}
