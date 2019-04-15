<?php

namespace Yaks\LogFields;

use Yaks\Interfaces\UserAgentAccess;

class UserAgentHeader extends LogField implements UserAgentAccess
{
    public function getUserAgent()
    {
        return $this->getData();
    }
}
