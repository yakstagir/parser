<?php

namespace Yaks;

use Generator;
use SplFileObject;

final class LogParser
{
    protected $logFile;

    private $logFormat;

    public function __construct($filePath, LogFormat $format)
    {
        $this->logFile   = new SplFileObject($filePath, 'rb');
        $this->logFormat = $format;
    }

    public function getFormattedLogLine(): Generator
    {
        foreach ($this->logFile as $line) {
            if (!empty($line)) {
                yield $this->logFormat->makeLogLine($line);
            }
        }
    }
}



