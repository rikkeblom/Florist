<?php

//change file name

require_once 'src/length.php';

use PHPUnit\Framework\TestCase;

class LengthTest extends TestCase
{

    /**
     * @dataProvider convertPasses
     */
        
    // ------------------------------------------
    // TEST CONVERT PASSES
    // ------------------------------------------
    public function testConvertPasses($measure, $system, $expected): void
    {
        $length = new Length($measure, $system);

        $result = $length->convert();

        $this->assertEquals($expected, $result);
    }

    public function convertPasses(): array
    {
        return [
            [0, Length::IMPERIAL, 0],
            [1, Length::IMPERIAL, 2.54],
            [0.5, Length::IMPERIAL, 1.27],
            [0.25, Length::IMPERIAL, 0.64],
            [7.077532027016991E+307, Length::IMPERIAL, 1.7976931348623157E+308],
            [0, Length::METRIC, 0],
            [2.54, Length::METRIC, 1],
            [1.27, Length::METRIC, 0.5],
            [0.635, Length::METRIC, 0.25],
            [-1, Length::IMPERIAL, 2.54],
            [-2.54, Length::METRIC, 1],
        ];
    }


    /**
     * @dataProvider convertFails
     */
        
    // ------------------------------------------
    // TEST CONVERT FAILS
    // ------------------------------------------
    public function testConvertFails($measure, $system, $expected): void
    {
        $length = new Length($measure, $system);

        $result = $length->convert();

        $this->assertNotEquals($expected, $result);
    }

    public function convertFails(): array
    {
        return [
            [-1, Length::IMPERIAL, -2.54],
            [7.077532027016992E+307, Length::IMPERIAL, 1.7976931348623157E+308],    // Upper invalid boundary
        ];
    }


    // ------------------------------------------
    // TEST INVALID SYSTEM ARGUMENT
    // ------------------------------------------
    public function testInvalidSystemArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $length = new Length(1, 'K');
    }
}
