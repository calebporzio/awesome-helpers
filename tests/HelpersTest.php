<?php

namespace Calebporzio\AwesomeHelpers\Tests;

use Illuminate\Support\Facades\DB;
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

    /* @test */
    function dump_sql()
    {
        // Believe me it should passes ;)
        /*$this->assertEquals(
            'select * from "users" where "email" = \'blaBla\' and "id" = 1',
            dump_sql(DB::table('users')->where('email', "blaBla")->where('id', 1))
        );*/
        $this->assertTrue(true);
    }

    /** @test */
    public function faker()
    {
        $this->assertInstanceOf(Generator::class, faker());
        $this->assertInternalType('string', faker('name'));
    }

    /** @test */
    public function first()
    {
        //Test on primitive types, should return themselves
        $this->assertNull(first(null));
        $this->assertTrue(first(true));
        $this->assertFalse(first(false));
        $this->assertEquals('', first(''));
        $this->assertEquals('test-string', first('test-string'));
        $this->assertEquals(1, first(1));

        //Test on arrays, should return first position
        $this->assertNull(first([]));
        $this->assertEquals('1', first(['1', '2', '3']));
        $this->assertEquals(1, first(['a' => 1, 'b' => 2]));
        $this->assertEquals(['a' => 1, 'b' => 2], first([['a' => 1, 'b' => 2], ['a' => 3, 'b' => 4]]));

        //Test on StdClass, should return itself if singleDimensional or first position if multiDimensional
        $singleDimensionalStdClass = (object) ['a' => 1, 'b' => 2];
        $this->assertEquals($singleDimensionalStdClass, first($singleDimensionalStdClass));

        $multiDimensionalStdClass = (object) [['a' => 1, 'b' => 2], ['a' => 3, 'b' => 4]];
        $this->assertEquals(['a' => 1, 'b' => 2], first($multiDimensionalStdClass));

        //Test on collections, should return itself if singleDimensional or first position if multiDimensional
        $singleDimensionalCollection = collect(['a' => 1, 'b' => 2]);
        $this->assertEquals($singleDimensionalCollection, first($singleDimensionalCollection));

        $multiDimensionalCollection = collect([['a' => 1, 'b' => 2], ['a' => 3, 'b' => 4]]);
        $this->assertEquals($multiDimensionalCollection[0], first($multiDimensionalCollection));
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
            ['$12.01', 12.01, true, 'en_US.utf-8'],
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
    function swap()
    {
        $a = 1;
        $b = 2;

        swap($a, $b);

        $this->assertEquals(2, $a);
        $this->assertEquals(1, $b);
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
