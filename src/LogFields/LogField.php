<?php

namespace Yaks\LogFields;

use Yaks\Interfaces\ProvidesDataAccess;

abstract class LogField implements ProvidesDataAccess
{
    protected $data = '';

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function __clone()
    {
        $this->data = '';
    }
}
