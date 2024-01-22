<?php

namespace Buildings\Form\Validation;

use Buildings\Databases\Objects\Architect;

/**
 * Class ArchitectValidator
 * @package Buildings\Form\Validation
 */
class ArchitectValidator implements Validator
{
    private array $errors = [];

    /**
     * ArchitectValidator constructor.
     *
     * @param Architect $architect
     */
    public function __construct(private readonly Architect $architect)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->architect->name == '') {
            $this->errors[] = 'Architect name cannot be empty';
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
