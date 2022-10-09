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

final class FunctionTypeReader implements TypeReaderInterface
{
    public function support(string|object $input): bool
    {
        if ($input instanceof \ReflectionFunction) {
            return true;
        }

        return false;
    }

    /**
     * @param \ReflectionFunction $input
     */
    public function readAttributes(string|object $input): array
    {
        if (\is_string($input) || !($input instanceof \ReflectionFunction)) {
            throw new \RuntimeException('FunctionTypeReader does not support string input');
        }

        return $input->getAttributes();
    }
}
