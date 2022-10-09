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

final class ClassConstantTypeReader implements TypeReaderInterface
{
    public function support(string|object $input): bool
    {
        if ($input instanceof \ReflectionClassConstant) {
            return true;
        }

        return false;
    }

    /**
     * @param \ReflectionClassConstant $input
     */
    public function readAttributes(string|object $input): array
    {
        if (\is_string($input) || !($input instanceof \ReflectionClassConstant)) {
            throw new \RuntimeException('ClassConstantTypeReader does not support string input');
        }

        return $input->getAttributes();
    }
}
