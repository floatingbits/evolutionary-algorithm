<?php


namespace FloatingBits\EvolutionaryAlgorithm;


use FloatingBits\EvolutionaryAlgorithm\Evaluation\EvaluatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Mutation\MutatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Recombination\RecombinatorInterface;
use FloatingBits\EvolutionaryAlgorithm\Selection\SelectorInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimen;
use FloatingBits\EvolutionaryAlgorithm\Specimen\RatableSpecimenInterface;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenCollection;
use FloatingBits\EvolutionaryAlgorithm\Specimen\SpecimenGeneratorInterface;

class Population
{
    /** @var SpecimenCollection */
    private $specimenCollection;

    /** @var SpecimenGeneratorInterface  */
    private $specimenGenerator;

    /** @var int  */
    private $populationSize;

    /** @var EvaluatorInterface  */
    private $evaluator;

    /** @var SelectorInterface  */
    private $selector;

    /** @var RecombinatorInterface  */
    private $recombinator;

    /** @var MutatorInterface  */
    private $mutator;

    public function __construct(int $populationSize,
                                SpecimenGeneratorInterface $specimenGenerator,
                                EvaluatorInterface $evaluator,
                                SelectorInterface  $selector,
                                RecombinatorInterface $recombinator,
                                MutatorInterface $mutator) {
        $this->populationSize = $populationSize;
        $this->specimenGenerator = $specimenGenerator;
        $this->evaluator = $evaluator;
        $this->selector = $selector;
        $this->recombinator = $recombinator;
        $this->mutator = $mutator;
    }

    public function initialize() {
        $this->specimenCollection = $this->specimenGenerator->generateSpecimen($this->populationSize);
    }

    public function evolve() {
        $this->evaluate();
        $this->select();
        $this->recombine();
        $this->mutate();
    }

    private function evaluate() {
        /** @var RatableSpecimenInterface $ratableSpecimen */
        foreach ($this->specimenCollection as $ratableSpecimen) {
            $ratableSpecimen->setRate($this->evaluator->evaluateSpecimen($ratableSpecimen->getSpecimen()));
        }
    }

    private function select() {
        $this->specimenCollection = $this->selector->select($this->specimenCollection);
    }

    private function recombine() {
        $this->specimenCollection = $this->recombinator->recombine($this->specimenCollection, $this->populationSize);
    }

    private function mutate() {
        $this->specimenCollection = $this->mutator->mutate($this->specimenCollection);
    }

}