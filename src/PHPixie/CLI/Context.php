<?php

namespace PHPixie\CLI;

interface Context
{
    public function inputStream();
    public function outputStream();
    public function errorStream();
    public function currentDirectory();
    public function arguments();
    public function setExitCode($exitCode);
    public function exitCode();
}
