<?php

namespace PHPixie\CLI\Context;

class SAPITest extends \PHPixie\Test\Testcase
{
    protected $builder;
    protected $context;

    public function setUp()
    {
        $this->builder = $this->quickMock('PHPixie\CLI\Builder');
        $this->context = new \PHPixie\CLI\Context\SAPI($this->builder);
    }

    public function testInputStream()
    {
        $this->streamTest('inputStream', 'input', STDIN);
    }

    public function testOutputStream()
    {
        $this->streamTest('outputStream', 'output', STDOUT);
    }

    public function testErrorStream()
    {
        $this->streamTest('errorStream', 'output', STDERR);
    }

    public function testCurrentDirectory()
    {
        for($i=0; $i<2; $i++) {
            $this->assertSame(getcwd(), $this->context->currentDirectory());
        }
    }

    public function testRawArguments()
    {
        global $argv;
        for($i=0; $i<2; $i++) {
            $this->assertSame($argv, $this->context->rawArguments());
        }
    }

    public function testArguments()
    {
        $context = $this->contextMock(array('rawArguments'));

        $this->method($context, 'rawArguments', array(
            '',
            'test',
            '-abc',
            '-d=4',
            'test2',
            '--debug',
            '--value=5'
        ), array(), 0);

        $options = $this->quickMock('\PHPixie\Slice\Data');
        $arguments = $this->quickMock('\PHPixie\Slice\Data');

        $this->assertSame(array(
            'a' => true,
            'b' => true,
            'c' => true,
            'd' => '4',
            'debug' => true,
            'value' => '5'
        ), $context->options());
        
        $this->assertSame(array(
            'test',
            'test2'
        ), $context->arguments());
    }

    protected function streamTest($method, $type, $resource)
    {
        $stream = $this->quickMock('PHPixie\CLI\Streams\\'.ucfirst($type));
        $this->method($this->builder, $type.'Stream', $stream, array($resource), 0);

        for($i=0; $i<2; $i++) {
            $this->assertSame($stream, call_user_func(array($this->context, $method)));
        }
    }

    protected function contextMock($methods)
    {
        return $this->getMock(
            '\PHPixie\CLI\Context\SAPI',
            $methods,
            array($this->builder)
        );
    }
}
