<?php

namespace Yaks;

use Yaks\LogFields\FinalStatus;
use Yaks\LogFields\FirstLineOfRequest;
use Yaks\LogFields\RefererHeader;
use Yaks\LogFields\RemoteHostname;
use Yaks\LogFields\RemoteLogname;
use Yaks\LogFields\RemoteUser;
use Yaks\LogFields\RequestReceivedTime;
use Yaks\LogFields\ResponseSize;
use Yaks\LogFields\UserAgentHeader;

class LogFormatFactory extends LogFormat
{
    public static function make(string $format): LogFormat
    {
        switch ($format) {
            case 'combined':
            default:
                $logFormat = new LogFormat(
                    new RemoteHostname(),
                    new RemoteLogname(),
                    new RemoteUser(),
                    new RequestReceivedTime(),
                    new FirstLineOfRequest(),
                    new FinalStatus(),
                    new ResponseSize(),
                    new RefererHeader(),
                    new UserAgentHeader()
                );
        }

        return $logFormat;
    }
}
