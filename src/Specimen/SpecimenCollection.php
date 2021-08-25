<?php
namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

class SpecimenCollection implements \Iterator
{
    /** @var \ArrayIterator  */
    private $ratableSpecimens;

    public function __construct() {
        $this->ratableSpecimens = new \ArrayIterator();
    }

    public function addSpecimen(RatableSpecimenInterface $specimen) {
        $this->ratableSpecimens->append($specimen);
    }

    public function removeSpecimen(int $key) {
        $this->ratableSpecimens->offsetUnset($key);
    }

    public function getSpecimen(int $key): RatableSpecimenInterface {
        return $this->ratableSpecimens->offsetGet($key);
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


}