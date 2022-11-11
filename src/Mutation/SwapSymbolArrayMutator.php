<?php


namespace FloatingBits\EvolutionaryAlgorithm\Mutation;


use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\IntRandomizerInterface;

/**
 * @implements MutatorInterface<SymbolArrayGenotypeInterface>
 */
class SwapSymbolArrayMutator implements MutatorInterface
{
    /** @var BooleanRandomizerInterface  */
    private $mutationProbabilityRandomizer;
    /** @var ConfigurableIntRandomizerInterface  */
    private $swapPartnerRandomizer;
    public function __construct(BooleanRandomizerInterface $mutationProbabilityRandomizer, ConfigurableIntRandomizerInterface $swapPartnerRandomizer) {
        $this->mutationProbabilityRandomizer = $mutationProbabilityRandomizer;
        $this->swapPartnerRandomizer = $swapPartnerRandomizer;
    }

    /**
     * @param SymbolArrayGenotypeInterface $genotype
     */
    public function mutate($genotype): SymbolArrayGenotypeInterface
    {
        $i = 0;
        $returnGenotype = clone $genotype;
        $this->swapPartnerRandomizer->setMax($genotype->getSymbolLength() - 1);
        while ($i < $genotype->getSymbolLength()) {
           if ($this->mutationProbabilityRandomizer->randomYesOrNo()) {
               $oldSymbol = $returnGenotype->getSymbolAt($i);
               $swapPosition = $this->swapPartnerRandomizer->randomInt();
               $swapSymbol = $returnGenotype->getSymbolAt($swapPosition);
               $returnGenotype->setSymbolAt($swapSymbol,$i);
               $returnGenotype->setSymbolAt($oldSymbol,$swapPosition);
           }
           $i++;
        }
        return $returnGenotype;
    }


}