<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem;

class Job
{
    /** @var int[]  */
    private $invalidMachines = [];
    /** @var float[]  */
    private $timeForMachines = [];
    /** @var float */
    private $defaultTime;

    /**
     * @param float $defaultTime
     */
    public function __construct(float $defaultTime) {
        $this->defaultTime = $defaultTime;
    }

    /**
     * @param int $machineNo
     * @return void
     */
    public function setMachineInvalid(int $machineNo) {
        if ($this->canBeDoneByMachineNo($machineNo)) {
            $this->invalidMachines[] = $machineNo;
        }
    }

    /**
     * @param int $machineNo
     * @param float $time
     * @return void
     */
    public function setMachineTime(int $machineNo, float $time) {
        $this->timeForMachines[$machineNo] = $time;
    }

    /**
     * @param int $machineNo
     * @return bool
     */
    public function canBeDoneByMachineNo(int $machineNo): bool {
        return  !in_array($machineNo, $this->invalidMachines);
    }

    /**
     * @param int $machineNo
     * @return float
     */
    public function getTimeForMachineNo(int $machineNo): float {
        return  $this->timeForMachines[$machineNo] ?? $this->defaultTime;
    }
}