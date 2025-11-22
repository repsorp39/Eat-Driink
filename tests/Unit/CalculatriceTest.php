<?php

namespace Tests\Unit;

use App\Services\Calculatrice;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CalculatriceTest extends TestCase
{

     public static function divisionProvider(): array
    {
        return [
            'division de 1 par 1'  => [1, 1, 1],
            'division de 1 par -1'  => [1, 1, -1],
            'division de 1 par 0' => [1, 0,\DivisionByZeroError::class],
        ];
    }

    #[DataProvider('divisionProvider')]
    public function testDivision(int $a, int $b, int|string $expected): void
    {
        if(is_string($expected)){
            $this->expectException($expected);
            Calculatrice::division($a,$b);
        }else{
            $result = Calculatrice::division($a, $b);
            $this->assertEquals(1,$result);
        }
    }

//     /** @test */
//    public function division_un_par_un(){
//         $result = Calculatrice::division(1,1);
//         $this->assertEquals(1,$result);
//    }

//    /** @test */
//    public function division_un_par_moins_un(){
//         $result = Calculatrice::division(1,-1);
//         $this->assertEquals(-1,$result);
//    }

//    /** @test */
//    public function division_un_par_zero(){
//         $this->expectException(\DivisionByZeroError::class);
//         Calculatrice::division(1,0);
//    }

}
   