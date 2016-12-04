<?php

namespace PHPixie\CLI\Context\Container;

interface Settable extends \PHPixie\CLI\Context\Container
{
    public function setCliContext($cliContext);
}