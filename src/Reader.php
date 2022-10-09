<?php

namespace ThemePoint\Attribute;

use ThemePoint\Attribute\Interfaces\TypeReaderInterface;
use ThemePoint\Attribute\TypeReader\ClassTypeReader;

class Reader
{
    private array $typeReader;

    public function __construct() {
        $this->typeReader = [
            new ClassTypeReader()
        ];
    }

    public function getAttributes(
        string|object $input
    ): array {
        $reader = $this->getTypeReader($input);

        if ($reader === null) {
            throw new \RuntimeException('No type reader found for input');
        }

        return $reader->readAttributes($input);
    }

    private function getTypeReader(string|object $input): ?TypeReaderInterface
    {
        foreach ($this->typeReader as $reader) {
            if ($reader->support($input)) {
                return $reader;
            }
        }

        return null;
    }
}