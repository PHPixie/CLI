<?php

namespace PHPixie;

class CLI
{
    /**
     * @var CLI\Builder
     */
    protected $builder;

    public function __construct($contextContainer = null)
    {
        $this->builder = $this->buildBuilder($contextContainer);
    }

    /**
     * 
     * @return \PHPixie\CLI\Context\SAPI
     */
    public function context()
    {
        return $this->builder->context();
    }
    
    public function buildSapiContext()
    {
        return $this->builder->buildSapiContext();
    }

    /**
     * 
     * @param type $contextContainer
     * @return \PHPixie\CLI\Builder
     */
    protected function buildBuilder($contextContainer)
    {
        return new CLI\Builder($contextContainer);
    }
}
