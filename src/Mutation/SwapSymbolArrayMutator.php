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
    /** @var int  */
    private $ratioOfSwaps;
    /** @var ConfigurableIntRandomizerInterface  */
    private $swapPartnerRandomizer;
    public function __construct(float $ratioOfSwaps, ConfigurableIntRandomizerInterface $swapPartnerRandomizer) {
        $this->ratioOfSwaps = $ratioOfSwaps;
        $this->swapPartnerRandomizer = $swapPartnerRandomizer;
    }

    /**
     * @param SymbolArrayGenotypeInterface $genotype
     */
    public function mutate($genotype): SymbolArrayGenotypeInterface
    {
        $returnGenotype = clone $genotype;
        $this->swapPartnerRandomizer->setMax($genotype->getSymbolLength() - 1);
        $numberOfSwaps = round($this->ratioOfSwaps * $returnGenotype->getSymbolLength());
        while ($numberOfSwaps--) {
            $oldPosition = $this->swapPartnerRandomizer->randomInt();
            $oldSymbol = $returnGenotype->getSymbolAt($oldPosition);
            $swapPosition = $this->swapPartnerRandomizer->randomInt();
            $swapSymbol = $returnGenotype->getSymbolAt($swapPosition);
            $returnGenotype->setSymbolAt($swapSymbol,$oldPosition);
            $returnGenotype->setSymbolAt($oldSymbol,$swapPosition);
        }
        return $returnGenotype;
    }


}