<?php
require_once __DIR__."/../vendor/autoload.php";
use PHPUnit\Framework\TestCase;
use ARG\Std\StdArray;

final class StdArrayTest extends TestCase{

    private $array_nums;

    public function __construct(){
        parent::__construct();
        $this->array_nums = StdArray::create(1,2,3,4,5);
    }

    /**
     * @test
     */
    public function from(){
        $original = [1,2,3,4];
        $arr = StdArray::from($original);
        $this->assertInstanceOf(StdArray::class, $arr);
        $this->assertEquals($original, $arr->original());
    }

    /**
     * @test
     */
    public function create(){
        $arr = StdArray::create(1,2,3,4);
        $this->assertInstanceOf(StdArray::class, $arr);
        $this->assertEquals([1,2,3,4], $arr->original());
    }

    /**
     * @test
     */
    public function changeKeyCase(){
        $array_base = ["test" => "value", "Test1" => "value"];
        $array = StdArray::from($array_base);
        $array_default = $array->changeKeyCase();
        $array_upper = $array->changeKeyCase(CASE_UPPER);
        $array_lower = $array->changeKeyCase(CASE_LOWER);

        $this->assertEquals($array_default->original(), array_change_key_case($array_base));
        $this->assertEquals($array_upper->original(), array_change_key_case($array_base, CASE_UPPER));
        $this->assertEquals($array_lower->original(), array_change_key_case($array_base, CASE_LOWER));
    }

    /**
     * @test
     */
    public function map(){

        $original = $this->array_nums->original();
        $double = function($x){
            return $x*2;
        };

        $normal_map = array_map($double, $original);
        $static_map = StdArray::applyMap($original, $double);
        $method_map = $this->array_nums->map($double);
        $this->assertEquals($normal_map, $static_map);
        $this->assertEquals($normal_map, $method_map->original());
    }

    /**
     * @test
     */
    public function filter(){

        $original = $this->array_nums->original();
        $greater_than_2 = function($x){
            return $x > 2;
        };

        $normal_filter = array_filter($original, $greater_than_2);
        $static_filter = StdArray::applyFilter($original, $greater_than_2);
        $method_filter = $this->array_nums->filter($greater_than_2);
        $this->assertEquals($normal_filter, $static_filter);
        $this->assertEquals($normal_filter, $method_filter->original());
    }

}
