<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


interface SpecimenGeneratorInterface
{
    /**
     * @param int $populationSize
     * @return SpecimenCollection
     */
    public function generateSpecimen(int $populationSize);
}