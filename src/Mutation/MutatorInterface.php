<?php
namespace FloatingBits\EvolutionaryAlgorithm\Mutation;
use FloatingBits\EvolutionaryAlgorithm\Genotype\GenotypeInterface;
/**
 * @template T of GenotypeInterface
 */
interface MutatorInterface
{
    /**
     * @param T $genotype
     * @return mixed
     */
    public function mutate($genotype);
}