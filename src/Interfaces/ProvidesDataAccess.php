<?php

namespace Yaks\Interfaces;

interface ProvidesDataAccess
{
    public function getData();

    public function setData($data);
}
