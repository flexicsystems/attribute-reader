<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace Flexic\Attributes\TypeReader;

use Flexic\Attributes\Interfaces\TypeReaderInterface;

final class ParameterTypeReader implements TypeReaderInterface
{
    public function support(string|object $input): bool
    {
        if ($input instanceof \ReflectionParameter) {
            return true;
        }

        return false;
    }

    /**
     * @param \ReflectionParameter $input
     */
    public function readAttributes(string|object $input): array
    {
        if (\is_string($input) || !($input instanceof \ReflectionParameter)) {
            throw new \RuntimeException('ParameterTypeReader does not support string input');
        }

        return $input->getAttributes();
    }
}
