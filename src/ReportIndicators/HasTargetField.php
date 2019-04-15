<?php

namespace Yaks\ReportIndicators;

use Yaks\LogFields\LogField;
use Yaks\LogLine;

trait HasTargetField
{
    public function getTargetField(LogLine $line): ?LogField
    {
        return $line->resolveField($this->needs());
    }

    abstract public function needs(): string;
}


