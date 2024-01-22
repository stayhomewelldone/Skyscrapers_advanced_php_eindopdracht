<?php

namespace Buildings\Handlers\FillAndValidate;

use Buildings\Form\Data;
use Buildings\Form\Validation\ArchitectValidator;

/**
 * Trait Architect
 * @package Buildings\Handlers
 */
trait Architect
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->architect->name = $this->formData->getPostVar('name');

            //Actual validation
            $validator = new ArchitectValidator($this->architect);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
