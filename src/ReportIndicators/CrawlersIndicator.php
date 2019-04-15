<?php

namespace Yaks\ReportIndicators;

use Yaks\CrawlerDetector;
use Yaks\Interfaces\UserAgentAccess;
use Yaks\LogLine;

class CrawlersIndicator extends ReportIndicator
{
    use HasTargetField;

    private $crawlers = [];

    /**
     * @var \Yaks\CrawlerDetector
     */
    private $crawlerDetector;

    public function __construct()
    {
        $this->crawlerDetector = new CrawlerDetector();
    }

    public function accumulate(LogLine $line)
    {
        /** @var UserAgentAccess $field */
        $field = $this->getTargetField($line);
        if ($field) {
            $crawler = $this->crawlerDetector->getCrawler($field->getUserAgent());
            if ($crawler) {
                if (!array_key_exists($crawler, $this->crawlers)) {
                    $this->crawlers[$crawler] = 0;
                }

                ++$this->crawlers[$crawler];
            }
        }
    }

    public function needs()
    {
        return UserAgentAccess::class;
    }

    public function value()
    {
        return $this->crawlers;
    }
}
