<?php

namespace Yaks\ReportIndicators;

use Yaks\LogLine;

class ViewsIndicator extends ReportIndicator
{
    private $value = 0;

    public function accumulate(LogLine $line)
    {
        if ($line->isValid()) {
            ++$this->value;
        }
    }

    public function value()
    {
        return $this->value;
    }
}
