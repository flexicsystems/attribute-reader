<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022-2022 ThemePoint
 *
 * @author Hendrik Legge <hendrik.legge@themepoint.de>
 *
 * @version 1.0.0
 */

namespace Flexic\Attributes;

use Flexic\Attributes\Interfaces\TypeReaderInterface;

final class Reader
{
    private array $typeReader;

    public function __construct()
    {
        $this->typeReader = [
            new TypeReader\ClassTypeReader(),
            new TypeReader\FunctionTypeReader(),
            new TypeReader\MethodTypeReader(),
            new TypeReader\PropertyTypeReader(),
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

    public function getAttribute(
        string|object $input,
        string $attributeName,
    ): ?\ReflectionAttribute {
        $attributes = $this->getAttributes($input);

        foreach ($attributes as $attribute) {
            if ($attribute->getName() === $attributeName) {
                return $attribute;
            }
        }

        return null;
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
