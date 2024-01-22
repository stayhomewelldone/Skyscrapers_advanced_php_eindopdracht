<?php

namespace Buildings\Form\Validation;

/**
 * Interface Validator
 * @package Buildings\Form\Validation
 */
interface Validator
{
    /**
     * Validate magic
     */
    public function validate(): void;

    /**
     * @return array
     */
    public function getErrors(): array;
}
