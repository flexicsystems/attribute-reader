<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace ThemePoint\Attributes;

use ThemePoint\Attributes\Interfaces\TypeReaderInterface;
use ThemePoint\Attributes\TypeReader\ClassTypeReader;

final class Reader
{
    private array $typeReader;

    public function __construct()
    {
        $this->typeReader = [
            new ClassTypeReader(),
        ];
    }

    public function getAttributes(
        string|object $input,
    ): array {
        $reader = $this->getTypeReader($input);

        if (null === $reader) {
            throw new \RuntimeException('No type attribute reader found for input');
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
