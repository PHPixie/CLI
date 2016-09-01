<?php

namespace PHPixie\Tests\CLI;

class PromptTest extends \PHPixie\Test\Testcase
{

    protected $contextContainer;
    protected $prompt;

    public function setUp()
    {
        $this->contextContainer = $this->quickMock('\PHPixie\CLI\Context\Container');
        $this->prompt = new \PHPixie\CLI\Prompt($this->contextContainer);
    }

    public function testTable()
    {
        $this->assertSame(
            "+-----+----+\n".
            "| abc | b  |\n".
            "+-----+----+\n".
            "| 1   | 1  |\n".
            "| 1   | 15 |\n".
            "+-----+----+\n",
            $this->prompt->table([
                ['abc' =>1, 'b' => 1],
                ['abc' =>1, 'b' => 15]
            ])
        );
    }
}
