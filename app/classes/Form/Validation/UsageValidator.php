<?php

namespace Buildings\Form\Validation;

use Buildings\Databases\Objects\Usage;

/**
 * Class UsageValidator
 * @package Buildings\Form\Validation
 */
class UsageValidator implements Validator
{
    private array $errors = [];

    /**
     * UsageValidator constructor.
     *
     * @param Usage $usage
     */
    public function __construct(private readonly Usage $usage)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->usage->name == '') {
            $this->errors[] = 'Usage name cannot be empty';
        }
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
