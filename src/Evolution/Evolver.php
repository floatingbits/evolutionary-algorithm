<?php


namespace FloatingBits\EvolutionaryAlgorithm\Evolution;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Phenotype\PhenotypeGeneratorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;
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

    public function __construct(SelectorInterface               $selector,
                                CollectionRecombinatorInterface $recombinator,
                                EvaluatorInterface $evaluator,
                                MutatorInterface $mutator,
                                PhenotypeGeneratorInterface $phenotypeGenerator) {
        $this->selector = $selector;
        $this->recombinator = $recombinator;
        $this->evaluator = $evaluator;
        $this->mutator = $mutator;
        $this->phenotypeGenerator = $phenotypeGenerator;
    }


    public function evolve(SpecimenCollection $specimens) {
        $populationSize = count($specimens);
        $this->evaluate($specimens);
        $specimens = $this->select($specimens);
        $specimens = $this->recombine($specimens, $populationSize);
        $this->mutate($specimens);
        return $specimens;
    }

    private function evaluate(SpecimenCollection $specimens) {

        /** @var SpecimenInterface $specimen */
        foreach ($specimens as $specimen) {
            $phenotype = $this->phenotypeGenerator->generatePhenotype($specimen->getGenotype());
            $fitness = $this->evaluator->evaluate($phenotype);
            $specimen->setEvaluation($fitness);
        }
    }

    private function select(SpecimenCollection $specimens) {
        return $this->selector->select($specimens);
    }

    private function recombine(SpecimenCollection $specimens, int $populationSize) {
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