<?php

namespace Yaks\ReportIndicators;

use Yaks\Interfaces\ResponseSizeAccess;
use Yaks\LogLine;

class TrafficIndicator extends ReportIndicator
{
    use HasTargetField;

    private $value = 0;

    public function accumulate(LogLine $line)
    {
        /** @var ResponseSizeAccess $field */
        $field = $this->getTargetField($line);
        if ($field) {
            $bytes = $field->getSizeInBytes();

            $this->value += $bytes;
        }
    }

    public function needs()
    {
        return ResponseSizeAccess::class;
    }

    public function value()
    {
        return $this->value;
    }
}
