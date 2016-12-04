<?php

namespace PHPixie\CLI;

class Builder
{
    /**
     *
     * @var \PHPixie\CLI\Context\Container\Implementation
     */
    protected $contextContainer;

    public function __construct($contextContainer = null)
    {
        $this->contextContainer = $contextContainer;
    }

    /**
     * 
     * @param string $resource
     * @return \PHPixie\CLI\Stream\Input
     */
    public function inputStream($resource)
    {
        return new Stream\Input($resource);
    }

    /**
     * 
     * @param string $resource
     * @return \PHPixie\CLI\Stream\Output
     */
    public function outputStream($resource)
    {
        return new Stream\Output($resource);
    }

    /**
     * 
     * @return \PHPixie\CLI\Context\SAPI
     */
    public function context()
    {
        return $this->contextContainer()->cliContext();
    }

    /**
     * 
     * @return \PHPixie\CLI\Context\Container\Implementation
     */
    public function contextContainer()
    {
        if($this->contextContainer === null) {
            $context = $this->buildSapiContext();
            $this->contextContainer = $this->buildContextContainer($context);
        }

        return $this->contextContainer;
    }

    /**
     * 
     * @param \PHPixie\CLI\Context\SAPI $context
     * @return \PHPixie\CLI\Context\Container\Implementation
     */
    public function buildContextContainer($context)
    {
        return new \PHPixie\CLI\Context\Container\Implementation($context);
    }

    /**
     * 
     * @return \PHPixie\CLI\Context\SAPI
     */
    public function buildSapiContext()
    {
        return new Context\SAPI($this);
    }
}
