<?php

namespace PHPixie\CLI;

class Prompt
{
    protected $contextContainer;

    public function __construct($contextContainer)
    {
        $this->contextContainer = $contextContainer;
    }

    public function prompt($string, $newLine = false)
    {
        $context = $this->context();
        $string.= $newLine ? "\n" : ' ';

        $context->outputStream()->write($string);
        return $context->inputStream()->readLine();
    }

    public function charPrompt($string)
    {
        $context->outputStream()->write($string.' ');
        return $context->inputStream()->read(1);
    }

    public function table($rows)
    {
        $sizes = array();
        foreach($rows as $i => $row) {
            $rows[$i] = (array) $row;
        }

        $keys = array_keys($rows[0]);

        foreach($keys as $key) {
            $sizes[$key] = strlen($key);
        }

        foreach($rows as $row) {
            foreach($keys as $key) {
                $length = strlen($row[$key]);
                if($sizes[$key] < $length) {
                    $sizes[$key] = $length;
                }
            }
        }

        foreach($sizes as $key => $size) {
            $sizes[$key]+= 3;
        }

        $separator = '';
        foreach($sizes as $size) {
            $separator.= str_pad('+', $size, '-');
        }
        $separator.="+\n";

        $result = $separator;

        $header = array_combine($keys, $keys);
        array_unshift($header, $rows);

        foreach($sizes as $key => $size) {
            $result.= str_pad('| '.$key, $size);
        }

        $result.="|\n";

        $result.= $separator;

        foreach($rows as $i => $row) {
            foreach($sizes as $key => $size) {
                $result.= str_pad('| '.$row[$key], $size);
            }

            $result.="|\n";
        }

        $result .= $separator;
        return $result;
    }

    protected function tableSeparator($sizes)
    {

    }

    protected function context()
    {
        return $this->contextContainer->cliContext();
    }
}
