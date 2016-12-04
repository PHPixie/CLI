<?php

namespace PHPixie\CLI\Context\Container;

class Implementation implements \PHPixie\CLI\Context\Container
{
    /**
     *
     * @var \PHPixie\CLI\Context\SAPI
     */
    protected $cliContext;
    
    /**
     * 
     * @param \PHPixie\CLI\Context\SAPI $cliContext
     */
    public function __construct($cliContext)
    {
        $this->cliContext = $cliContext;
    }

    /**
     * 
     * @return \PHPixie\CLI\Context\SAPI
     */
    public function cliContext()
    {
        return $this->cliContext;
    }

    public function setCliContext($cliContext)
    {
        return $this->cliContext = $cliContext;
    }
}
