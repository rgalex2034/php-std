<?php
namespace ARG\Std\Type;

abstract class Base{

    public abstract static function from($value);

    public static function create(...$args){
        return new static(...$args);
    }

    public abstract function original();

}
