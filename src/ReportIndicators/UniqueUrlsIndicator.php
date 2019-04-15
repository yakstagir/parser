<?php

namespace Yaks\ReportIndicators;

use Yaks\Interfaces\UrlAccess;
use Yaks\LogLine;

class UniqueUrlsIndicator extends ReportIndicator
{
    use HasTargetField;

    private $urls = [];

    public function accumulate(LogLine $line)
    {
        /** @var UrlAccess $field */
        $field = $this->getTargetField($line);
        if ($field) {
            $url = $field->getUrl();
            if ($url) {
                if (!isset($this->urls[$url])) {
                    $this->urls[$url] = 0;
                }

                ++$this->urls[$url];
            }
        }
    }

    public function value()
    {
        return count($this->urls);
    }

    public function needs()
    {
        return UrlAccess::class;
    }
}
