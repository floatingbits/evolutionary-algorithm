<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Randomizer;

use FloatingBits\EvolutionaryAlgorithm\Randomizer\LinearBias;
use PHPUnit\Framework\TestCase;

class LinearBiasTest extends TestCase
{
    public function testGetBias() {
        $linearBias = new LinearBias();

        $min = 0;
        $max = 10;

        $bias = 0.5;
        $biasedValue = $linearBias->getBiasedValue(5,$bias,$max, $min);
        $this->assertEquals(0, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(6,$bias,$max, $min);
        $this->assertEquals(2, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(9,$bias,$max, $min);
        $this->assertEquals(8, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(4,$bias,$max, $min);
        $this->assertEquals(0, $biasedValue);

        $bias = 2;
        $biasedValue = $linearBias->getBiasedValue(5,$bias,$max, $min);
        $this->assertEquals(10, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(6,$bias,$max, $min);
        $this->assertEquals(10, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(1,$bias,$max, $min);
        $this->assertEquals(2, $biasedValue);
        $biasedValue = $linearBias->getBiasedValue(4,$bias,$max, $min);
        $this->assertEquals(8, $biasedValue);
    }
}