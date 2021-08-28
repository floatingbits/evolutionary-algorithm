<?php
namespace FloatingBits\EvolutionaryAlgorithm\Mutation;

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