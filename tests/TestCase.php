<?php

namespace Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    public function setUp()
    {
        require __DIR__ . '/../vendor/autoload.php';
    }
}
