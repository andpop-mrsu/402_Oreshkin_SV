<?php

namespace Tests\VectorTest;

use App\Vector;
use PHPUnit\Framework\TestCase;

class VectorTest extends TestCase
{
    public function testAddition()
    {
        $v1 = new Vector(2, 2.3, 7);
    
        $v2 = new Vector(1, 2.7, -3);

        $this->assertSame("(3;5;4)", $v1->add($v2)->__toString());
    }

    public function testSubtraction()
    {
        $v1 = new Vector(2, 2.3, 7);
    
        $v2 = new Vector(1, 2.7, -3);

        $this->assertSame("(1; -0.4; 10)", $v1->sub($v2)->__toString());
    }

    public function testNumberProduct()
    {
        $v1 = new Vector(2, 2.3, 7);

        $this->assertSame("(4;4.6;14)", $v1->product(2)->__toString());
    }

    public function testScalarProduct()
    {
        $v1 = new Vector(2, 2.3, 7);
    
        $v2 = new Vector(1, 2.7, -3);

        $this->assertEquals(-12.79, $v1->scalarProduct($v2));
    }

    public function testVectorProduct()
    {
        $v1 = new Vector(2, 2.3, 7);
    
        $v2 = new Vector(1, 2.7, -3);

        $this->assertSame("(25.8;-13;-3.1)", $v1->vectorProduct($v2)->__toString());
    }
}
