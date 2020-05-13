<?php
require_once __DIR__."/../vendor/autoload.php";
use PHPUnit\Framework\TestCase;

final class StdArrayTest extends TestCase{

    /**
     * @test
     */
    public function from(){
        $original = [1,2,3,4];
        $arr = ARG\Std\StdArray::from($original);
        $this->assertInstanceOf(ARG\Std\StdArray::class, $arr);
        $this->assertEquals($original, $arr->original());
    }

    /**
     * @test
     */
    public function create(){
        $arr = ARG\Std\StdArray::create(1,2,3,4);
        $this->assertInstanceOf(ARG\Std\StdArray::class, $arr);
        $this->assertEquals([1,2,3,4], $arr->original());
    }

}
