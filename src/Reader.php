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

    public function getFilteredAttributes(
        string|object $input,
        string|array $filter,
    ): array {
        $reader = $this->getTypeReader($input);

        if (null === $reader) {
            throw new \RuntimeException('No type attribute reader found for input');
        }

        if (\is_string($filter)) {
            $filter = [$filter];
        }

        return \array_filter($reader->readAttributes($input), static function (?\ReflectionAttribute $attribute) use ($filter) {
            if (null === $attribute) {
                return false;
            }

            return \in_array($attribute->getName(), $filter, true);
        });
    }

    public function getAttribute(
        string|object $input,
        string $attribute,
    ): ?\ReflectionAttribute {
        $attributes = $this->getAttributes($input);

        foreach ($attributes as $classAttribute) {
            if ($classAttribute->getName() === $attribute) {
                return $classAttribute;
            }
        }

        return null;
    }

    public function hasAttribute(
        string|object $input,
        string $attribute,
    ): bool {
        $attributes = $this->getAttributes($input);

        foreach ($attributes as $classAttribute) {
            if ($classAttribute->getName() === $attribute) {
                return true;
            }
        }

        return false;
    }

    public function findClassesWithAttribute(
        string $attribute,
    ): array {
        $declaredClasses = \get_declared_classes();
        $classes = [];

        foreach ($declaredClasses as $class) {
            if (null !== $this->getAttribute($class, $attribute)) {
                $classes[] = $class;
            }
        }

        return $classes;
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
