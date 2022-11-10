<?php

namespace FloatingBits\EvolutionaryAlgorithm\Tests\unit\Example\AssignJobToMachinesExample\Problem;

use FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem\Job;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    public function testDefaultTime() {
        $defaultTime = 55.4;
        $defaultMachineNo = 33;
        $defaultMachineNo2 = 34;
        $job = new Job($defaultTime);
        $specialTime = 50.0;
        $specialMachineNo = 32;
        $job->setMachineTime($specialMachineNo, $specialTime);
        $this->assertEquals($defaultTime, $job->getTimeForMachineNo($defaultMachineNo));
        $this->assertEquals($defaultTime, $job->getTimeForMachineNo($defaultMachineNo2));
        $this->assertEquals($specialTime, $job->getTimeForMachineNo($specialMachineNo));
    }

    public function testInvalidMachine() {
        $defaultTime = 55.4;
        $defaultMachineNo = 33;
        $defaultMachineNo2 = 34;
        $job = new Job($defaultTime);
        $invalidMachineNo = 32;
        $job->setMachineInvalid($invalidMachineNo);
        $this->assertTrue($job->canBeDoneByMachineNo($defaultMachineNo));
        $this->assertTrue($job->canBeDoneByMachineNo($defaultMachineNo2));
        $this->assertFalse($job->canBeDoneByMachineNo($invalidMachineNo));
    }

}