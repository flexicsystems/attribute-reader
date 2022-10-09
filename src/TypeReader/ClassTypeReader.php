<?php

namespace ThemePoint\Attribute\TypeReader;

use ThemePoint\Attribute\Interfaces\TypeReaderInterface;

class ClassTypeReader implements TypeReaderInterface
{
    public function support(string|object $input): bool
    {
        if (\is_string($input) && \class_exists($input)) {
            return true;
        }

        if (\is_object($input) && \class_exists($input::class)) {
            return true;
        }

        if (\is_object($input) && $input::class === \ReflectionClass::class) {
            return true;
        }

        return false;
    }

    public function readAttributes(string|object $input): array
    {
        // TODO: Implement readAttributes() method.
    }
}