<?php


namespace FloatingBits\EvolutionaryAlgorithm;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\CollectionRecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

class Evolver
{
    /** @var SelectorInterface  */
    private $selector;

    /** @var CollectionRecombinatorInterface  */
    private $recombinator;


    public function __construct(SelectorInterface               $selector,
                                CollectionRecombinatorInterface $recombinator) {
        $this->selector = $selector;
        $this->recombinator = $recombinator;
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

        foreach ($specimens as $specimen) {
            $specimen->evaluate();
        }
    }

    private function select(SpecimenCollection $specimens) {
        return $this->selector->select($specimens);
    }

    private function recombine(SpecimenCollection $specimens, int $populationSize) {
        return $this->recombinator->recombine($specimens, $populationSize);
    }

    private function mutate(SpecimenCollection $specimens) {
        foreach ($specimens as $specimen) {
            $specimen->mutate();
        }
    }

}