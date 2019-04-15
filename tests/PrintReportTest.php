<?php

namespace Tests;

use Yaks\LogFormatFactory;
use Yaks\LogParser;
use Yaks\Report;
use Yaks\ReportIndicators\CrawlersIndicator;
use Yaks\ReportIndicators\StatusCodesIndicator;
use Yaks\ReportIndicators\TrafficIndicator;
use Yaks\ReportIndicators\UniqueUrlsIndicator;
use Yaks\ReportIndicators\ViewsIndicator;

class PrintReportTest extends TestCase
{
    public function setUp()
    {
        ini_set("auto_detect_line_endings", true);
        parent::setUp();
    }

    /** * @test */
    public function parser_process_file_and_prints_report_test()
    {
        $report = new Report([
            'views'       => new ViewsIndicator(),
            'urls'        => new UniqueUrlsIndicator(),
            'traffic'     => new TrafficIndicator(),
            'crawlers'    => new CrawlersIndicator(),
            'statusCodes' => new StatusCodesIndicator(),
        ]);

        $parser = new LogParser(__DIR__ . '/../access_log.txt', LogFormatFactory::make('combined'));

        foreach ($parser->getFormattedLogLine() as $logLine) {
            $report->accumulate($logLine);
        }

        // https://gist.github.com/flrnull/7304afeb9e8a1f4faec3
        // Непонятный формат лога, где код 301
        // Поэтому лог был изменен. Но значения траффика не совпадают.
        $expected = json_encode([
            'views'   => 16,
            'urls'    => 5,
            'traffic' => 187990,

            'crawlers' => [
                'Google' => 2,
            ],

            'statusCodes' => [
                '200' => 14,
                '301' => 2,
            ],
        ]);

        $this->assertEquals($expected, $report->toJson());
    }
}
