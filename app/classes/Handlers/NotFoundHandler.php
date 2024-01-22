<?php

namespace Buildings\Handlers;

/**
 * Class NotFoundHandler
 * @package Buildings\Handlers
 */
class NotFoundHandler extends BaseHandler
{
    protected function index(): void
    {
        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => '404 - Page not found'
        ]);
    }
}
