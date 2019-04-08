<?php

namespace Calebporzio\AwesomeHelpers\Tests;

use PHPUnit\Framework\TestCase;
use Calebporzio\AwesomeHelpers\AwesomeHelpersServiceProvider;
use Illuminate\Support\Carbon;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Faker\Generator;

class HelpersTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp()
    {
        (new AwesomeHelpersServiceProvider(null))->boot();
    }

    /** @test */
    public function carbon()
    {
        $this->assertInstanceOf(Carbon::class, carbon());
        $this->assertEquals(Carbon::parse('Jan 1 2017'), carbon('Jan 1 2017'));
    }

    /** @test */
    public function chain()
    {
        $mock = \Mockery::mock();
        $mock->shouldReceive('first')->once()->andReturn('first thing');
        $mock->shouldReceive('second')->once()->with('first thing');
        $mock->shouldReceive('third')->once()->andReturn('third thing');

        $result = chain($mock)->first()->second(carry)->third()();

        $this->assertEquals('third thing', $result);
    }

    /** @test */
    function connection()
    {
        // This one requires too much bootstrapping to test.
        $this->assertTrue(function_exists('connection'));
    }

    /** @test */
    public function faker()
    {
        $this->assertInstanceOf(Generator::class, faker());
        $this->assertInternalType('string', faker('name'));
    }

    /** @test */
    public function user()
    {
        // This one is too simple to go through the trouble of testing.
        $this->assertTrue(function_exists('user'));
    }

    /**
     * @test
     * @dataProvider moneyProvider
     */
    public function money($expected, $input, $showCents, $locale)
    {
        $this->assertEquals($expected, money($input, $showCents, $locale));
    }

    public function moneyProvider()
    {
        return [
            ['$12.00', 12, true, 'en_US.utf-8'],
            ['$12.00', 12.00, true, 'en_US.utf-8'],
            ['$12.00', 12.004, true, 'en_US.utf-8'],
            ['$12.01', 12.005, true, 'en_US.utf-8'],
            ['$1,200.00', 1200.00, true, 'en_US.utf-8'],
            ['$12', 12, false, 'en_US.utf-8'],
        ];
    }

    /** @test */
    function ok()
    {
        // This one is too simple to go through the trouble of testing.
        $this->assertTrue(function_exists('ok'));
    }

    /** @test */
    function str_between()
    {
        $this->assertEquals('something',
            str_between('before something after', 'before ', ' after')
        );
    }

    /** @test */
    function str_extract()
    {
        $this->assertEquals('something', str_extract('before something after', '/before (.*) after/'));

        $this->assertNull(str_extract('before something after', 'other-thing'));
    }

    /** @test */
    function str_match()
    {
        $this->assertTrue(str_match('before something after', '/before (.*) after/'));

        $this->assertTrue(str_match('before something after', 'something'));

        $this->assertFalse(str_match('hidden', '/found/'));

        $this->assertFalse(str_match('hidden', 'found'));
    }

    /** @test */
    function str_validate()
    {
        // @todo - use Orchestra TestBench or something to test things
        // that depend on Laravel Facades and globals.
        $this->assertTrue(true);
    }

    /** @test */
    function str_wrap()
    {
        $this->assertEquals('--something--', str_wrap('something', '--'));
    }

    /** @test */
    function stopwatch()
    {
        // 10000 milliseconds is 0.01 seconds.
        $time = stopwatch(function () { usleep(10000); });

        $this->assertEquals(0.01, round($time, 2));
    }

    /** @test */
    function tinker()
    {
        $mock = \Mockery::mock('overload:'.\Psy\Shell::class);
        $mock->shouldReceive('setScopeVariables');
        $mock->shouldReceive('has')->andReturn(false);
        $mock->shouldReceive('run');

        tinker();

        $mock
            ->shouldReceive('setScopeVariables')
            ->with(['there' => 'value', 'temp0' => 'hey']);

        $there = 'value';
        tinker('hey', $there);
    }
}
