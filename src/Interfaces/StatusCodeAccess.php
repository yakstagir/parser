<?php

namespace Yaks\Interfaces;

interface StatusCodeAccess extends ProvidesDataAccess
{
    public function getStatus();
}
