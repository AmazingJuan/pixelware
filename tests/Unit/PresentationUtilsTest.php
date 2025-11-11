<?php

namespace Tests\Unit;

use App\Utils\PresentationUtils;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class PresentationUtilsTest extends TestCase
{
    #[Test]
    public function it_formats_0_cents()
    {
        $this->assertEquals('0.00', PresentationUtils::formatCurrency(0));
    }

    #[Test]
    public function it_formats_5_cents()
    {
        $this->assertEquals('0.05', PresentationUtils::formatCurrency(5));
    }

    #[Test]
    public function it_formats_99_cents()
    {
        $this->assertEquals('0.99', PresentationUtils::formatCurrency(99));
    }

    #[Test]
    public function it_formats_100_cents()
    {
        $this->assertEquals('1.00', PresentationUtils::formatCurrency(100));
    }

    #[Test]
    public function it_formats_12345_cents()
    {
        $this->assertEquals('123.45', PresentationUtils::formatCurrency(12345));
    }

    #[Test]
    public function it_formats_1000000_cents()
    {
        $this->assertEquals('10,000.00', PresentationUtils::formatCurrency(1000000));
    }

    #[Test]
    public function it_formats_987654321_cents()
    {
        $this->assertEquals('9,876,543.21', PresentationUtils::formatCurrency(987654321));
    }

    #[Test]
    public function it_formats_1_cents()
    {
        $this->assertEquals('0.01', PresentationUtils::formatCurrency(1));
    }

    #[Test]
    public function it_formats_101_cents()
    {
        $this->assertEquals('1.01', PresentationUtils::formatCurrency(101));
    }

    #[Test]
    public function it_formats_1001_cents()
    {
        $this->assertEquals('10.01', PresentationUtils::formatCurrency(1001));
    }
}
