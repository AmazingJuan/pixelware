<?php

namespace Tests\Unit;

use App\Utils\MathUtils;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MathUtilsTest extends TestCase
{
    #[Test]
    public function it_calculates_case1()
    {
        $this->assertEqualsWithDelta(55.0, MathUtils::calculateNewAverage(50.0, 60, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case2()
    {
        $this->assertEqualsWithDelta(75.0, MathUtils::calculateNewAverage(50.0, 100, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case3()
    {
        $this->assertEqualsWithDelta(40.0, MathUtils::calculateNewAverage(30.0, 50, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case4()
    {
        $this->assertEqualsWithDelta(75.0, MathUtils::calculateNewAverage(100.0, 50, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case5()
    {
        $this->assertEqualsWithDelta(30.0, MathUtils::calculateNewAverage(25.0, 35, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case6()
    {
        $this->assertEqualsWithDelta(90.0, MathUtils::calculateNewAverage(80.0, 100, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case7()
    {
        $this->assertEqualsWithDelta(62.5, MathUtils::calculateNewAverage(50.0, 75, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case8()
    {
        $this->assertEqualsWithDelta(25.0, MathUtils::calculateNewAverage(20.0, 30, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case9()
    {
        $this->assertEqualsWithDelta(65.0, MathUtils::calculateNewAverage(50.0, 80, 1), 0.0001);
    }

    #[Test]
    public function it_calculates_case10()
    {
        $this->assertEqualsWithDelta(44.2, MathUtils::calculateNewAverage(33.3, 66, 2), 0.0001);
    }
}
