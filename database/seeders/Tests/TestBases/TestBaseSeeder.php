<?php

namespace Database\Seeders\Tests\TestBases;

use App\Models\Test;
use App\Models\TestBase;
use Illuminate\Database\Seeder;

abstract class TestBaseSeeder extends Seeder
{
    protected ?Test $test;

    protected function __construct(string $testCode)
    {
        $this->test = Test::where('code', $testCode)->first();
    }

    protected function setBases(array $bases): void
    {
        if (!$this->test) return;
        
        foreach ($bases as $base) {
            TestBase::firstOrCreate(
                ['code' => $base['code']],
                array_merge($base, ['test_id' => $this->test->id])
            );
        }
    }
}
