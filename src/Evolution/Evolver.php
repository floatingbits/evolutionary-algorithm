<?php


namespace FloatingBits\EvolutionaryAlgorithm\Evolution;


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

    /** @var bool */
    private $shouldPreventRegression;

    /** @var SimpleSelector  */
    private $crossGenerationSelector;

    public function __construct(SelectorInterface               $selector,
                                CollectionRecombinatorInterface $recombinator,
                                EvaluatorInterface $evaluator,
                                MutatorInterface $mutator,
                                PhenotypeGeneratorInterface $phenotypeGenerator,
                                $shouldPreventRegression = true) {
        $this->selector = $selector;
        $this->recombinator = $recombinator;
        $this->evaluator = $evaluator;
        $this->mutator = $mutator;
        $this->phenotypeGenerator = $phenotypeGenerator;
        $this->shouldPreventRegression = $shouldPreventRegression;
        if ($shouldPreventRegression) {
            $this->crossGenerationSelector = new SimpleSelector(0.5);
        }
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
        if ($this->shouldPreventRegression) {
            $newGeneration = $this->preventRegression($newGeneration, $oldGeneration);
        }
        return $newGeneration;
    }

    /**
     * @param SpecimenCollection $newGeneration
     * @param SpecimenCollection $oldGeneration
     * @return SpecimenCollection
     */
    private function preventRegression(SpecimenCollection $newGeneration, SpecimenCollection $oldGeneration):SpecimenCollection {
        $newGeneration->combine($oldGeneration);
        $this->evaluate($newGeneration);
        return $this->crossGenerationSelector->select($newGeneration);
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
        return $this->selector->select($specimens);
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
        /** @var SpecimenInterface $specimen */
        foreach ($specimens as $specimen) {
            $genotype = $this->mutator->mutate($specimen->getGenotype());
            $specimen->setGenotype($genotype);
        }
    }

}