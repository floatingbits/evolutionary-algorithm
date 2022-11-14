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
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenInterface;

class Evolver implements EvolverInterface
{
    /** @var SelectorInterface  */
    private $selector;

    /** @var CollectionRecombinatorInterface  */
    private $recombinator;

    /** @var EvaluatorInterface  */
    private $evaluator;

    /** @var MutatorInterface  */
    private $mutator;

    /** @var PhenotypeGeneratorInterface  */
    private $phenotypeGenerator;

    /** @var float */
    private $protectFromMutationRate;
    /** @var CleanupInterface */
    private $cleanupStrategy;
    public function __construct(SelectorInterface               $selector,
                                CollectionRecombinatorInterface $recombinator,
                                EvaluatorInterface $evaluator,
                                MutatorInterface $mutator,
                                PhenotypeGeneratorInterface $phenotypeGenerator,
                                $protectFromMutationRate = 0,
                                CleanupInterface $cleanupStrategy = null) {
        $this->selector = $selector;
        $this->recombinator = $recombinator;
        $this->evaluator = $evaluator;
        $this->mutator = $mutator;
        $this->phenotypeGenerator = $phenotypeGenerator;
        $this->protectFromMutationRate = $protectFromMutationRate;
        $this->cleanupStrategy = $cleanupStrategy ?? new DefaultCleanup();
    }

    public function cleanup(SpecimenCollection $oldGeneration)
    {
        $populationSize = count($oldGeneration);
        return $this->recombine($this->cleanupStrategy->cleanup($oldGeneration), $populationSize);
    }

    /**
     * @param float $protectFromMutationRate
     */
    public function setProtectFromMutationRate($protectFromMutationRate): void
    {
        $this->protectFromMutationRate = $protectFromMutationRate;
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
        $newGeneration = $this->recombine($newGeneration, $populationSize);
        $this->mutate($newGeneration);
        $this->evaluate($newGeneration);
        $newGeneration->sortByFitness();

        return $newGeneration;
    }

    /**
     * @param SpecimenCollection $newGeneration
     * @param SpecimenCollection $oldGeneration
     * @return SpecimenCollection
     */
    private function preventRegression(SpecimenCollection $newGeneration, SpecimenCollection $oldGeneration):SpecimenCollection {

        $this->evaluate($newGeneration);
        $maxPreservedSpecimen = $preservedSpecimenCount = 5;
        while ($preservedSpecimenCount) {}
        if ($newGeneration->getSpecimen($maxPreservedSpecimen - $preservedSpecimenCount)->getEvaluation()->getMainFitness() <
                $oldGeneration->getSpecimen($maxPreservedSpecimen - $preservedSpecimenCount)->getEvaluation()->getMainFitness()
        ) {
            $newGeneration->removeSpecimen($newGeneration->count() - 1 - $maxPreservedSpecimen + $preservedSpecimenCount);
            $newGeneration->addSpecimen($oldGeneration->getSpecimen($maxPreservedSpecimen - $preservedSpecimenCount));
            $preservedSpecimenCount--;
        }

        return $newGeneration;
    }

    private function evaluate(SpecimenCollection $specimens) {

        /** @var SpecimenInterface $specimen */
        foreach ($specimens as $specimen) {
            $phenotype = $this->phenotypeGenerator->generatePhenotype($specimen->getGenotype());
            $fitness = $this->evaluator->evaluate($phenotype);
            $specimen->setEvaluation($fitness);
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
    private function recombine(SpecimenCollection $specimens, int $populationSize):SpecimenCollection {
        return $this->recombinator->recombine($specimens, $populationSize);
    }

    private function mutate(SpecimenCollection $specimens) {
        $numberOfProtectedSpecimen = floor($this->protectFromMutationRate * $specimens->count());
        /** @var SpecimenInterface $specimen */
        foreach ($specimens as $key => $specimen) {
            if ($key >= $numberOfProtectedSpecimen) {
                $genotype = $this->mutator->mutate($specimen->getGenotype());
                $specimen->setGenotype($genotype);
            }

        }
    }

}