<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace Flexic\Attributes\Interfaces;

interface TypeReaderInterface
{
    /**
     * Returns true if the reader can read the given type.
     */
    public function support(string|object $input): bool;

    /**
     * Reads the attributes.
     */
    public function readAttributes(string|object $input): array;
}
