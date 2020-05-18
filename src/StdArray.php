<?php
namespace ARG\Std;

class StdArray extends Type\Base implements \ArrayAccess, \Countable{

    private $array;

    public function __construct(...$elements){
        $this->array = $elements;
    }

    public static function from($array){
        $instance = self::create();
        foreach($array as $key => $value){
            $instance[$key] = $value;
        }
        return $instance;
    }

    public function original(){
        return $this->array;
    }

    public static function applyChangeKeyCase(array $array, int $case = CASE_LOWER){
        return array_change_key_case($array, $case);
    }

    public function changeKeyCase(int $case = CASE_LOWER){
        return self::from(self::applyChangeKeyCase($this->array, $case));
    }

    public static function applyMap(array $array, callable $callable, ?array ...$arrays){
        return $arrays
            ? array_map($callable, $array, ...$arrays)
            : array_map($callable, $array);
    }

    public function map(callable $callable, ?array ...$arrays){
        $new_array = self::applyMap($this->array, $callable, ...$arrays);
        return self::from($new_array);
    }

    public static function applyFilter(array $array, callable $callable, int $flag = 0){
        return array_filter($array, $callable, $flag);
    }

    public function filter(callable $callable, int $flag = 0){
        $new_array = array_filter($this->array, $callable, $flag);
        return self::from($new_array);
    }

    public function offsetExists($offset){
        return isset($this->array[$offset]);
    }

    public function offsetGet($offset){
        return $this->array[$offset];
    }

    public function offsetSet($offset, $value){
        $this->array[$offset] = $value;
    }

    public function offsetUnset($offset){
        unset($this->array[$offset]);
    }

    public function count(){
        return count($this->array);
    }

}
