<?php
namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

class SpecimenCollection implements \Iterator, \Countable
{
    /** @var SpecimenInterface[]  */
    private $ratableSpecimens;

    public function __construct() {
        $this->ratableSpecimens = [];
    }

    public function addSpecimen(SpecimenInterface $specimen) {
        $this->ratableSpecimens[] = $specimen;
    }

    public function removeSpecimen(int $key) {
        unset($this->ratableSpecimens[$key]);
    }

    public function getSpecimen(int $key): SpecimenInterface {
        return $this->ratableSpecimens[$key];
    }

    /**
     * @return float
     */
    public function getBestMainFitness(): float {
        $this->sortByFitness();
        return $this->getSpecimen(0)->getEvaluation()->getMainFitness();
    }

    public function sortByFitness(callable $equalsSortFunction = null) {
        uasort($this->ratableSpecimens, function(SpecimenInterface $a, SpecimenInterface $b) use($equalsSortFunction) {
            if ($a->getEvaluation()->getMainFitness() > $b->getEvaluation()->getMainFitness()) {
                return -1;
            }
            elseif ($a->getEvaluation()->getMainFitness() < $b->getEvaluation()->getMainFitness()) {
                return 1;
            }
            if ($equalsSortFunction) {
                return $equalsSortFunction($a, $b);
            }
            return 0;
        });
        $this->ratableSpecimens = array_values($this->ratableSpecimens);
    }

    public function current()
    {
        return current($this->ratableSpecimens);
    }

    public function next()
    {
        next($this->ratableSpecimens);
    }

    public function key()
    {
        return  key($this->ratableSpecimens);
    }

    public function valid(): bool
    {
        return isset($this->ratableSpecimens[$this->key()]);
    }

    public function rewind()
    {
        reset($this->ratableSpecimens);
    }

    public function count(): int
    {
        return count($this->ratableSpecimens);
    }

    public function combine(SpecimenCollection $collection) {
        $this->ratableSpecimens = array_merge($this->ratableSpecimens, ...array_values((array)$collection));
    }


}