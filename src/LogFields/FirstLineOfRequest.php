<?php

namespace Yaks\LogFields;

use Yaks\Interfaces\UrlAccess;

class FirstLineOfRequest extends LogField implements UrlAccess
{
    public function getUrl()
    {
        return $this->getData();
    }
}
