<?php

namespace DevLabor\GermanHolidays\Tests;

use DevLabor\GermanHolidays\Holidays;
use PHPUnit\Framework\TestCase;

class HolidaysTest extends TestCase
{
    /** @test */
    public function it_has_holidays_for_every_state_and_national()
    {
        $holidays = Holidays::get();

        $this->assertEquals(17, count($holidays));
    }

    /** @test */
    public function it_has_holidays_for_saxony_anhalt()
    {
        $holidays = Holidays::get(null, Holidays::STATE_SAXONY_ANHALT);

        $this->assertGreaterThan(5, count($holidays));
    }

    /** @test */
    public function it_has_national_holidays()
    {
        $holidays = Holidays::get();

        $this->assertArrayHasKey('NATIONAL', $holidays);
    }

    /** @test */
    public function it_resolves_federal_state_name_of_saxony_anhalt()
    {
        $federalStateName = Holidays::resolveFederalStateName('Sachsen-Anhalt');
        $holidays = Holidays::get(null, $federalStateName);

        $this->assertIsArray($holidays);
    }

    /** @test */
    public function it_resolves_federal_state_name_of_hamburg()
    {
        $federalStateName = Holidays::resolveFederalStateName('Hamburg');
        $holidays = Holidays::get(null, $federalStateName);

        $this->assertIsArray($holidays);
    }

    /** @test */
    public function it_resolves_federal_state_name_of_thuringia()
    {
        $federalStateName = Holidays::resolveFederalStateName('Thüringen');
        $holidays = Holidays::get(null, $federalStateName);

        $this->assertIsArray($holidays);
    }

    /** @test */
    public function it_returns_empty()
    {
        $holidays = Holidays::get(null, 'Sachsen-Anhalt');

        $this->assertEmpty($holidays);
    }

    /** @test */
    public function is_eastern_on_correct_days()
    {
        $holidays = Holidays::get();
        $eastern = date("Y-m-d", easter_date());
        $date = new \DateTime($eastern);
        $date->modify('+1 day');

        $this->assertEquals($holidays['NATIONAL']['Ostermontag']['datum'], $date->format('Y-m-d'));
    }
}
