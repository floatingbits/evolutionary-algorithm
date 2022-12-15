<?php

namespace FloatingBits\EvolutionaryAlgorithm\Recombination;

use FloatingBits\EvolutionaryAlgorithm\Evaluation\FitnessInterface;
use FloatingBits\EvolutionaryAlgorithm\Genotype\SymbolArrayGenotypeInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BiasedRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BiasInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\BooleanRandomizerInterface;
use FloatingBits\EvolutionaryAlgorithm\Randomizer\ConfigurableIntRandomizerInterface;

/**
 * @implements IndividualRecombinatorInterface<SymbolArrayGenotypeInterface, FitnessInterface>
 */
class SymbolArrayCrossoverRecombinator implements IndividualRecombinatorInterface
{
    private $numberOfCrossovers;
    /**
     * @var ConfigurableIntRandomizerInterface
     */
    private $intRandomizer;
    /**
     * @var BooleanRandomizerInterface
     */
    private $booleanRandomizer;

    /**
     * @var bool
     */
    private $considerRating;
    /**
     * @param int $numberOfCrossovers
     * @param ConfigurableIntRandomizerInterface $intRandomizer
     * @param BooleanRandomizerInterface $booleanRandomizer
     * @param bool $considerRating
     */
    public function __construct(int $numberOfCrossovers,
                                ConfigurableIntRandomizerInterface $intRandomizer,
                                BooleanRandomizerInterface $booleanRandomizer,
                                bool $considerRating)
    {
        $this->numberOfCrossovers = $numberOfCrossovers;
        $this->intRandomizer = $intRandomizer;
        $this->booleanRandomizer = $booleanRandomizer;
        $this->considerRating = $considerRating;
    }

    /**
     * @param SymbolArrayGenotypeInterface $genotype1
     * @param SymbolArrayGenotypeInterface $genotype2
     * @param FitnessInterface|null $rating1
     * @param FitnessInterface|null $rating2
     * @return SymbolArrayGenotypeInterface
     */
    public function recombine($genotype1, $genotype2, $rating1 = null, $rating2 = null): SymbolArrayGenotypeInterface
    {
        $startWith1 = $this->booleanRandomizer->randomYesOrNo();

        $currentGenotype = $startWith1 ? $genotype1 : $genotype2;
        $nextGenotype = $startWith1 ? $genotype2 : $genotype1;
        $currentRating = $startWith1 ? $rating1 : $rating2;
        $nextRating = $startWith1 ? $rating2 : $rating1;
        $returnGenotype = clone $currentGenotype;

        $crossoverPartsLeft = $this->numberOfCrossovers + 1;
        $currentPosition = 0;
        $length = $returnGenotype->getSymbolLength();
        while ($crossoverPartsLeft--) {
            if ($crossoverPartsLeft) {
                $avgIncrement = round(($length - $currentPosition) / ($crossoverPartsLeft + 1));

                $maxIncrement = min(2 * $avgIncrement, $length - $currentPosition);
                $this->intRandomizer->setMax($maxIncrement);
                $this->intRandomizer->setMin(0);
                if ($this->intRandomizer instanceof BiasedRandomizerInterface) {
                    $ratingRatio = 1;
                    if ($this->considerRating) {
                        $ratingRatio = $nextRating->getMainFitness() / $currentRating->getMainFitness();
                        if ($currentRating->getMainFitness() < 0) {
                            //Fitness is actually cost!
                            $ratingRatio = 1 / $ratingRatio;
                        }
                    }

                    $this->intRandomizer->setBias(
                        $ratingRatio
                    );
                }
                $increment = $this->intRandomizer->randomInt();
            }
            else {
                $increment = $length - $currentPosition;
            }
            $this->crossover($currentGenotype, $returnGenotype, $currentPosition, $increment);
            $this->swap($currentGenotype, $nextGenotype);
            $this->swap($currentRating, $nextRating);
            $currentPosition += $increment;
        }
        return $returnGenotype;
    }

    private function swap(&$x, &$y) {
        $tmp=$x;
        $x=$y;
        $y=$tmp;
    }
    /**
     * @param SymbolArrayGenotypeInterface $source
     * @param SymbolArrayGenotypeInterface $target
     * @param int $startPosition
     * @param int $length
     */
    private function crossover(SymbolArrayGenotypeInterface $source,SymbolArrayGenotypeInterface $target,int $startPosition,int $length) {
        $position = $startPosition;
        while ($length--) {
            $target->setSymbolAt($source->getSymbolAt($position), $position);
            $position++;
        }
    }


}