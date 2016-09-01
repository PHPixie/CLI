<?php

namespace PHPixie\CLI;

class Builder
{
    protected $contextContainer;

    public function __construct($contextContainer = null)
    {
        $this->contextContainer = $contextContainer;
    }

    public function inputStream($resource)
    {
        return new Stream\Input($resource);
    }

    public function outputStream($resource)
    {
        return new Stream\Output($resource);
    }

    public function context()
    {
        return $this->contextContainer()->cliContext();
    }

    public function contextContainer()
    {
        if($this->contextContainer === null) {
            $context = $this->buildSapiContext();
            $this->contextContainer = $this->buildContextContainer($context);
        }

        return $this->contextContainer;
    }

    public function buildContextContainer($context)
    {
        return new \PHPixie\CLI\Context\Container\Implementation($context);
    }

    public function buildSapiContext()
    {
        return new Context\SAPI($this);
    }
}
