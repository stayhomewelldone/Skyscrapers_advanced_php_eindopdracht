<?php

namespace Buildings\Handlers;

/**
 * Class HomeHandler
 * @package Buildings\Handlers
 * @noinspection PhpUnused
 */
class HomeHandler extends BaseHandler
{
    protected function index(): void
    {
        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Welcome to this skyscraper collection!'
        ]);
    }
}
