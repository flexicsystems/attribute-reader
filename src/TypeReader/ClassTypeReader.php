<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace ThemePoint\Attributes\TypeReader;

use ThemePoint\Attributes\Interfaces\TypeReaderInterface;

final class ClassTypeReader implements TypeReaderInterface
{
    public function support(string|object $input): bool
    {
        if (\is_string($input) && \class_exists($input)) {
            return true;
        }

        if (\is_object($input) && \class_exists($input::class)) {
            return true;
        }

        if (\is_object($input) && \ReflectionClass::class === $input::class) {
            return true;
        }

        return false;
    }

    public function readAttributes(string|object $input): array
    {
        if (\is_string($input)) {
            $input = new \ReflectionClass($input);
        }

        if (\is_object($input) && \class_exists($input::class) && \ReflectionClass::class !== $input::class) {
            $input = new \ReflectionClass($input::class);
        }

        if (\ReflectionClass::class !== $input::class) {
            throw new \RuntimeException('Invalid input for class type reader');
        }

        return $input->getAttributes();
    }
}
