<?php

namespace PHPixie\CLI\Context\Container;

class Implementation implements \PHPixie\CLI\Context\Container
{
    protected $cliContext;

    public function __construct($cliContext)
    {
        $this->cliContext = $cliContext;
    }

    public function cliContext()
    {
        return $this->cliContext;
    }

    public function setCLIContext($cliContext)
    {
        return $this->cliContext = $cliContext;
    }
}
