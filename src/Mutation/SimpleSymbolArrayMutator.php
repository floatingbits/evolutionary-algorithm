<?php


namespace FloatingBits\EvolutionaryAlgorithm\Mutation;


use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizerInterface;

/**
 * @implements MutatorInterface<SymbolArrayGenotypeInterface>
 */
class SimpleSymbolArrayMutator implements MutatorInterface
{
    private $mutationProbabilityRandomizer;
    public function __construct(BooleanRandomizerInterface $mutationProbabilityRandomizer) {
        $this->mutationProbabilityRandomizer = $mutationProbabilityRandomizer;
    }

    /**
     * @param SymbolArrayGenotypeInterface $genotype
     */
    public function mutate($genotype): SymbolArrayGenotypeInterface
    {
        $i = 0;
        $returnGenotype = clone $genotype;
        while ($i < $genotype->getSymbolLength()) {
           if ($this->mutationProbabilityRandomizer->randomYesOrNo()) {
               //@todo getRandomSymbol should be taken out of genotypes responsibility
               $returnGenotype->setSymbolAt($genotype->getRandomSymbol(),$i);
           }
           $i++;
        }
        return $returnGenotype;
    }


}