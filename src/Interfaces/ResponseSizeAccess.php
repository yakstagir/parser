<?php

namespace Yaks\Interfaces;

interface ResponseSizeAccess extends ProvidesDataAccess
{
    public function getSizeInBytes(): int;
}
