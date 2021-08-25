<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


interface SpecimenGeneratorInterface
{
    public function generateSpecimen(int $populationSize);
}