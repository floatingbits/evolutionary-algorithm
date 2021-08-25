<?php


namespace FloatingBits\EvolutionaryAlgorithm\Specimen;


interface RatableSpecimenInterface
{
    public function getRate():float;
    public function setRate(float $rate);
    public function getSpecimen();
}