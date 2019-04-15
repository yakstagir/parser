<?php

namespace Yaks\Interfaces;

interface UrlAccess extends ProvidesDataAccess
{
    public function getUrl();
}
