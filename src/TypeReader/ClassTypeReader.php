<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace ThemePoint\Attribute\TypeReader;

use ThemePoint\Attribute\Interfaces\TypeReaderInterface;

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
        // TODO: Implement readAttributes() method.
    }
}
