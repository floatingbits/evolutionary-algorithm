<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizer;
use PHPUnit\Framework\TestCase;

class BooleanRandomizerTest extends TestCase
{
    public function testTrivialCases() {
        $randomizer1 = new BooleanRandomizer(0);
        $count = 0;
        for ($i=0; $i<100; $i++) {
            if ($randomizer1->randomYesOrNo()) {
                $count++;
            }
        }
        $this->assertEquals(0,$count, "Probability 0 should never result in a true");
        $randomizer2 = new BooleanRandomizer(1);
        $count = 0;
        for ($i=0; $i<100; $i++) {
            if ($randomizer2->randomYesOrNo()) {
                $count++;
            }
        }
        $this->assertEquals(100,$count, "Probability 1 should result in a true in all 100 cases");
    }


    public function testCreateInstanceWithException() {
        $this->expectException(\InvalidArgumentException::class);
        $booleanRandomizer = new BooleanRandomizer(1.5);
    }
}
