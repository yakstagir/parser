<?php

namespace Yaks\ReportIndicators;

use Yaks\Interfaces\StatusCodeAccess;
use Yaks\LogLine;

class StatusCodesIndicator extends ReportIndicator
{
    use HasTargetField;

    private $codes = [];

    public function accumulate(LogLine $line)
    {
        /** @var StatusCodeAccess $field */
        $field = $this->getTargetField($line);
        if ($field) {
            $status = $field->getStatus();
            if ($status) {
                if (!array_key_exists($status, $this->codes)) {
                    $this->codes[$status] = 0;
                }

                $this->codes[$status]++;
            }
        }
    }

    public function value()
    {
        return $this->codes;
    }

    public function needs()
    {
        return StatusCodeAccess::class;
    }
}
