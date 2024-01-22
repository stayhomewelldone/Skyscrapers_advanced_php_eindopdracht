<?php

namespace Buildings\Handlers\FillAndValidate;

use Buildings\Form\Data;
use Buildings\Form\Validation\UsageValidator;

/**
 * Trait Usage
 * @package Buildings\Handlers
 */
trait Usage
{
    private Data $formData;

    public function executePostHandler(): void
    {
        if (isset($_POST['submit'])) {
            //Set form data
            $this->formData = new Data($_POST);

            //Override object with new variables
            $this->usage->name = $this->formData->getPostVar('name');

            //Actual validation
            $validator = new UsageValidator($this->usage);
            $validator->validate();
            $this->errors = $validator->getErrors();
        }
    }
}
