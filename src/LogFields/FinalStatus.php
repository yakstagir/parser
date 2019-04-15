<?php

namespace Yaks\LogFields;

use Yaks\Interfaces\StatusCodeAccess;

class FinalStatus extends LogField implements StatusCodeAccess
{
    public function getStatus()
    {
        return $this->getData();
    }
}
