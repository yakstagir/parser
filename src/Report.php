<?php

namespace Yaks;

final class Report
{
    /**
     * @var \Yaks\ReportIndicators\ReportIndicator[]
     */
    private $indicators;

    public function __construct(array $fields)
    {
        $this->indicators = $fields;
    }

    public function accumulate(LogLine $line)
    {
        foreach ($this->indicators as $indicator) {
            $indicator->accumulate($line);
        }
    }

    public function toArray()
    {
        $result = [];

        foreach ($this->indicators as $name => $indicator) {
            $result[$name] = $indicator->value();
        }

        return $result;
    }
    
    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
