<?php

namespace Yaks\Interfaces;

interface UserAgentAccess extends ProvidesDataAccess
{
    public function getUserAgent();
}
