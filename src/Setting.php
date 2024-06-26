<?php

namespace Invays\Ymlfeed;

class Setting
{
    protected $encoding = 'utf-8';
    protected $output_file;

    public function setEncoding(string $encoding): object
    {
        $this->encoding = $encoding;
        return $this;
    }

    public function getEncoding(): string
    {
        return $this->encoding;
    }

    public function setOutputFile(string $output_file): object
    {
        $this->output_file = $output_file;
        return $this;
    }

    public function getOutputFile(): string
    {
        return $this->output_file;
    }

}
