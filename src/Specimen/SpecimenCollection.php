<?php
namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

class SpecimenCollection implements \Iterator, \Countable
{
    /** @var \ArrayIterator  */
    private $ratableSpecimens;

    public function __construct() {
        $this->ratableSpecimens = new \ArrayIterator();
    }

    public function addSpecimen(SpecimenInterface $specimen) {
        $this->ratableSpecimens->append($specimen);
    }

    public function removeSpecimen(int $key) {
        $this->ratableSpecimens->offsetUnset($key);
    }

    public function getSpecimen(int $key): SpecimenInterface {
        return $this->ratableSpecimens->offsetGet($key);
    }

    public function sortByFitness() {
        $this->ratableSpecimens->uasort(function(SpecimenInterface $a, SpecimenInterface $b) {
            if ($a->getEvaluation()->getMainFitness() > $b->getEvaluation()->getMainFitness()) {
                return -1;
            }
            elseif ($a->getEvaluation()->getMainFitness() < $b->getEvaluation()->getMainFitness()) {
                return 1;
            }
            return 0;
        });

    }

    public function current()
    {
        return $this->ratableSpecimens->current();
    }

    public function next()
    {
        $this->ratableSpecimens->next();
    }

    public function key()
    {
        return  $this->ratableSpecimens->key();
    }

    public function valid()
    {
        return $this->ratableSpecimens->valid();
    }

    public function rewind()
    {
        $this->ratableSpecimens->rewind();
    }

    public function count()
    {
        return $this->ratableSpecimens->count();
    }


}