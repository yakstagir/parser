<?php

namespace Yaks;

use Yaks\LogFields\LogField;

class LogLine
{
    private $fields = [];

    public function add(LogField $logField, $key)
    {
        $this->fields[$key] = $logField;
    }

    public function isValid()
    {
        return !empty($this->fields);
    }

    public function resolveField($key): ?LogField
    {
        if (array_key_exists($key, $this->fields)) {
            return $this->fields[$key];
        }

        return null;
    }
}
