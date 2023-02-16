<?php


namespace FloatingBits\EvolutionaryAlgorithm\Evolution;


use FloatingBits\EvolutionaryAlgorithm\Cleanup\CleanupInterface;
use FloatingBits\EvolutionaryAlgorithm\Cleanup\DefaultCleanup;
use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SimpleSelector;
use FloatingBits\EvolutionaryAlgorithm\Specimen\CollectionReplenishInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;

class Evolver implements EvolverInterface
{
    /** @var SelectorInterface  */
    private $selector;

    /** @var CollectionReplenishInterface[]  */
    private $replenishers;

    /** @var CollectionReplenishInterface[]  */
    private $creativeReplenishers;

    /** @var EvaluatorInterface  */
    private $evaluator;

    /** @var PhenotypeGeneratorInterface  */
    private $phenotypeGenerator;
    /** @var CleanupInterface */
    private $cleanupStrategy;
    public function __construct(SelectorInterface               $selector,
                                array $replenishers,
                                EvaluatorInterface $evaluator,
                                PhenotypeGeneratorInterface $phenotypeGenerator,
                                array $creativeReplenishers = [],
                                CleanupInterface $cleanupStrategy = null) {
        $this->selector = $selector;
        $this->replenishers = $replenishers;
        $this->evaluator = $evaluator;
        $this->phenotypeGenerator = $phenotypeGenerator;
        $this->creativeReplenishers = $creativeReplenishers;
        $this->cleanupStrategy = $cleanupStrategy ?? new DefaultCleanup();
    }

    public function cleanup(SpecimenCollection $oldGeneration)
    {
        $populationSize = count($oldGeneration);
        return $this->replenish($this->cleanupStrategy->cleanup($oldGeneration), $populationSize, true);
    }

    /**
     * @param SpecimenCollection $oldGeneration
     * @return SpecimenCollection
     */
    public function evolve(SpecimenCollection $oldGeneration): SpecimenCollection {
        $populationSize = count($oldGeneration);
        $this->evaluate($oldGeneration);
        $oldGeneration->sortByFitness();
        $newGeneration = $this->select($oldGeneration);
        $newGeneration = $this->replenish($newGeneration, $populationSize, false);

        return $newGeneration;
    }


    private function evaluate(SpecimenCollection $specimens) {

        /** @var SpecimenInterface $specimen */
        foreach ($specimens as $specimen) {
            $phenotype = $this->phenotypeGenerator->generatePhenotype($specimen->getGenotype());
            $fitness = $this->evaluator->evaluate($phenotype);
            $specimen->setEvaluation($fitness);
            $specimen->setPhenotype($phenotype);
        }
    }

    /**
     * @param SpecimenCollection $specimens
     * @return SpecimenCollection
     */
    private function select(SpecimenCollection $specimens):SpecimenCollection {
        return $this->selector->select($specimens, false);
    }

    /**
     * @param SpecimenCollection $specimens
     * @param int $populationSize
     * @return SpecimenCollection
     */
    private function replenish(SpecimenCollection $specimens, int $populationSize, bool $beCreative):SpecimenCollection {
        $currentPopulationSize = count($specimens);
        $replenishers = ($beCreative && count($this->creativeReplenishers)) ?
            $this->creativeReplenishers : $this->replenishers;
        $totalWeight = 0;
        foreach ($replenishers as $replenisher) {
            $totalWeight += $replenisher->getWeight();
        }

        $totalNumSpecimenToReplenish = $populationSize - $currentPopulationSize;
        foreach ($replenishers as $replenisher) {
            $currentNumSpecimenToReplenish = ceil($totalNumSpecimenToReplenish * $replenisher->getWeight() / $totalWeight);
            $currentPopulationSize += $currentNumSpecimenToReplenish;
            $specimens = $replenisher->replenish($specimens, min($populationSize, $currentPopulationSize));
            $this->evaluate($specimens);
            $specimens->sortByFitness();
        }
        return $specimens;
    }

}