<?php
namespace FloatingBits\EvolutionaryAlgorithm\Specimen;

class RatableSpecimen implements RatableSpecimenInterface
{
    /** @var float */
    private $rate;
    private $specimen;

    /**
     * @return mixed
     */
    public function getRate() :float
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate(float $rate): void
    {
        $this->rate = $rate;
    }

    /**
     * @return mixed
     */
    public function getSpecimen()
    {
        return $this->specimen;
    }

    /**
     * @param mixed $specimen
     */
    public function setSpecimen($specimen): void
    {
        $this->specimen = $specimen;
    }

}