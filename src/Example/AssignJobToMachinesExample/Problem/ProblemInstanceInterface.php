<?php

namespace FloatingBits\EvolutionaryAlgorithm\Example\AssignJobToMachinesExample\Problem;

interface ProblemInstanceInterface
{
    /** @return Job[] */
    public function getJobs(): array;
    /** @return int */
    public function getNumberOfMachines(): int;
}