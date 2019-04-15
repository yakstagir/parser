<?php

namespace Yaks\LogFields;

use Yaks\Interfaces\ResponseSizeAccess;

class ResponseSize extends LogField implements ResponseSizeAccess
{
    public function getSizeInBytes(): int
    {
        return (int) $this->getData();
    }
}
