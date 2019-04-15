<?php

namespace Yaks\ReportIndicators;

use Yaks\LogLine;

abstract class ReportIndicator
{
    abstract public function accumulate(LogLine $line);

    abstract public function value();
}
