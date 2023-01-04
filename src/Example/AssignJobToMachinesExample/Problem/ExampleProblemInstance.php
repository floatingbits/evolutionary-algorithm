<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem;

class ExampleProblemInstance extends AbstractProblem
{
    /**
     * @return Job[]
     */
    public function getJobs(): array
    {
        $jobs = [];
        $jobs[] = new Job(33.1);
        $jobs[] = new Job(115.1);
        $jobs[] = new Job(27.1);
        $jobs[] = new Job(147.1);
        $jobs[] = new Job(10.1);
        $jobs[] = new Job(13.5);
        $jobs[] = new Job(8.1);
        $jobs[] = new Job(0.2);
        $jobs[] = new Job(30.3);
        $jobs[] = new Job(2.1);
        $jobs[] = new Job(0.4);
        $jobs[] = new Job(32.2);
        $jobs[] = new Job(113.1);
        $jobs[] = new Job(47.1);
        $jobs[] = new Job(34.2);
        $jobs[] = new Job(2.2);
        $jobs[] = new Job(42.1);
        $jobs[] = new Job(121.4);
        $jobs[] = new Job(42.2);
        $jobs[] = new Job(13.5);
        $jobs[] = new Job(8.1);
        $jobs[] = new Job(0.2);
        $jobs[] = new Job(120.3);
        $jobs[] = new Job(2.1);
        $jobs[] = new Job(60.4);
        $jobs[] = new Job(32.2);
        $jobs[] = new Job(113.1);
        $jobs[] = new Job(44.1);
        $jobs[] = new Job(34.2);
        $jobs[] = new Job(22.2);
        $jobs[] = new Job(42.1);
        $jobs[] = new Job(11.4);
        $jobs[] = new Job(42.2);
        return $jobs;
    }

    public function getNumberOfMachines(): int
    {
        return 5;
    }

}