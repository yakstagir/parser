<?php

namespace Yaks;

class CrawlerDetector
{
    const CRAWLER_GOOGLE = 'Google';
    const CRAWLER_YANDEX = 'Yandex';
    const CRAWLER_BING   = 'Bing';
    const CRAWLER_BAIDU  = 'Baidu';

    private $crawlers = [
        'Googlebot'          => self::CRAWLER_GOOGLE,
        'Google Web Preview' => self::CRAWLER_GOOGLE,
        'YandexBot'          => self::CRAWLER_YANDEX,
        'bingbot'            => self::CRAWLER_BING,
        'Baiduspider'        => self::CRAWLER_BAIDU,
    ];

    private $regexp   = '';

    public function __construct()
    {
        $this->regexp = implode('|', array_keys($this->crawlers));
    }

    public function getCrawler(string $userAgent): string
    {
        $matches    = [];
        $hasMatches = preg_match("/{$this->regexp}/", $userAgent, $matches);
        $bot        = $hasMatches !== false ? $matches[0] : null;

        return array_key_exists($bot, $this->crawlers) ? $this->crawlers[$bot] : '';
    }

    public function isCrawler(string $userAgent): bool
    {
        return (bool) preg_match("/{$this->regexp}/", $userAgent);
    }
}
