<?php

namespace ThemePoint\Attribute\Interfaces;

interface TypeReaderInterface
{
    /**
     * Returns true if the reader can read the given type.
     *
     * @param mixed $input
     * @return bool
     */
    public function support(string|object $input): bool;

    /**
     * Reads the attributes
     *
     * @param mixed $input
     * @return array
     */
    public function readAttributes(string|object $input): array;
}