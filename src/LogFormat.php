<?php namespace Yaks;

use ReflectionClass;
use ReflectionException;
use Yaks\Interfaces\ProvidesDataAccess;
use Yaks\LogFields\LogField;

class LogFormat
{
    /** @var LogField[] */
    protected $fields;

    protected $lineDelimiter   = ' ';

    protected $targetInterface = ProvidesDataAccess::class;

    protected $logLine;

    protected $fieldsCount;

    public function __construct(...$fields)
    {
        foreach ($fields as $field) {
            $interfaceName = $this->getDataProviderInterface($field);
            if ($interfaceName) {
                $this->fields[$interfaceName] = $field;
            } else {
                $this->fields[] = $field;
            }
        }

        $this->fieldsCount = count($this->fields);
    }

    private function getDataProviderInterface(LogField $field): string
    {
        try {
            $reflectionClass = new ReflectionClass($field);
            foreach ($reflectionClass->getInterfaces() as $interfaceName => $interface) {
                if ($interface->isSubclassOf($this->targetInterface)) {
                    return $interfaceName;
                }
            }
        } catch (ReflectionException $exception) {
        }

        return '';
    }

    public function makeLogLine(string $line): LogLine
    {
        $parsed  = $this->parse($line);
        $logLine = new LogLine();

        reset($parsed);
        if (count($parsed) == $this->fieldsCount) {
            foreach ($this->fields as $key => $field) {
                $data        = current($parsed);
                $clonedField = clone $field;

                $clonedField->setData($data);
                $logLine->add($clonedField, $key);
                next($parsed);
            }
        }

        return $logLine;
    }

    private function parse($line): array
    {
        $result      = [];
        $field       = '';
        $isWaiting   = false;
        $waitingChar = '';

        foreach ($this->split($line) as $char) {
            if (!$isWaiting) {
                if ($char === $this->lineDelimiter || $char === PHP_EOL) {
                    $result[] = $field;
                    $field    = '';
                } elseif ($char === '[') {
                    $isWaiting   = true;
                    $waitingChar = ']';
                } elseif ($char === '"') {
                    $isWaiting   = true;
                    $waitingChar = '"';
                } else {
                    $field .= $char;
                }
            } elseif ($char === $waitingChar) {
                $isWaiting   = false;
                $waitingChar = '';
            } else {
                $field .= $char;
            }
        }

        return $result === false ? [] : $result;
    }

    public function getLineDelimiter()
    {
        return $this->lineDelimiter;
    }

    private function split($line)
    {
        return str_split($line);
    }
}
