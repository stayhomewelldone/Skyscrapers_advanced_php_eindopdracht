<?php

namespace Buildings\Form\Validation;

use Buildings\Databases\Objects\Skyscraper;

/**
 * Class SkyscraperValidator
 * @package Buildings\Form\Validation
 */
class SkyscraperValidator implements Validator
{
    private array $errors = [];

    /**
     * SkyscraperValidator constructor.
     *
     * @param Skyscraper $skyscraper
     */
    public function __construct(private readonly Skyscraper $skyscraper)
    {
    }

    /**
     * Validate the data
     */
    public function validate(): void
    {
        //Check if data is valid & generate error if not so
        if ($this->skyscraper->architect_id == '') {
            $this->errors[] = 'Architect cannot be empty';
        }
        if ($this->skyscraper->name == '') {
            $this->errors[] = 'Skyscraper cannot be empty';
        }
        if (empty($this->skyscraper->getUsageIds())) {
            $this->errors[] = 'You need to choose at least 1 usage';
        }
        if ($this->skyscraper->built_year == '') {
            $this->errors[] = 'Built year cannot be empty';
        }
        if (!is_numeric($this->skyscraper->built_year) || strlen($this->skyscraper->built_year) != 4) {
            $this->errors[] = 'Built year needs to be a number with the length of 4';
        }
        if ($this->skyscraper->floors == '') {
            $this->errors[] = 'floors cannot be empty';
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
