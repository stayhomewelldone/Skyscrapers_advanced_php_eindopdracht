<?php

namespace Buildings\Handlers\FillAndValidate;

use Buildings\Databases\Objects\Usage;
use Buildings\Form\Data;
use Buildings\Form\Validation\SkyscraperValidator;

/**
 * Trait Skyscraper
 * @package Buildings\Handlers
 */
trait Skyscraper
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->skyscraper->architect_id = $this->formData->getPostVar('architect-id');
            $this->skyscraper->name = $this->formData->getPostVar('name');
            $this->skyscraper->built_year = $this->formData->getPostVar('built_year');
            $this->skyscraper->floors = (int)$this->formData->getPostVar('floors');
            $this->skyscraper->setUsageIds($this->formData->getPostVar('usage-ids'));

            //Actual validation
            $validator = new SkyscraperValidator($this->skyscraper);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
