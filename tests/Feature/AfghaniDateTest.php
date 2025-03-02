<?php
namespace EmalHamza\AfghaniDate\Tests\Feature;

use YourVendor\AfghaniDate\AfghaniDate;
use PHPUnit\Framework\TestCase;

class AfghaniDateTest extends TestCase
{
    public function testToAfghaniDate()
    {
        $date = AfghaniDate::toAfghaniDate('2025-03-02');
        $this->assertEquals('Sunday, 2 March 2025', $date); // Placeholder result
    }

    public function testToGregorianDate()
    {
        $date = AfghaniDate::toGregorianDate('1446-01-02');
        $this->assertEquals('2025-03-02', $date); // Placeholder result
    }
}
