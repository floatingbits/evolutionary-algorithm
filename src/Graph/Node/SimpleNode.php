<?php

namespace FloatingBits\EvolutionaryAlgorithm\Graph\Node;

class SimpleNode implements NodeInterface
{
    use DirectedLinksContainerTrait;
    /** @var mixed $content*/
    private $content;
    public function __construct()
    {
        $this->incomingLinks = new \SplObjectStorage();
        $this->outgoingLinks = new \SplObjectStorage();
    }
    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }


    public function __clone()
    {
        if (is_object($this->content)) {
            $this->content = clone $this->content;
        }
        $this->outgoingLinks = clone $this->outgoingLinks;
        $this->incomingLinks = clone $this->incomingLinks;
    }

}