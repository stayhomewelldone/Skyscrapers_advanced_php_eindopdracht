<?php

namespace Buildings\Handlers;

use Buildings\Databases\Objects\Usage;

/**
 * Class UsageHandler
 * @package Buildings\Handlers
 * @noinspection PhpUnused
 */
class UsageHandler extends BaseHandler
{
    use FillAndValidate\Usage;

    private Usage $usage;

    protected function index(): void
    {
        //Get all usages
        $usages = Usage::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Usages',
            'usages' => $usages,
            'totalUsages' => count($usages)
        ]);
    }

    protected function create(): void
    {
        //Set default empty usage & execute POST logic
        $this->usage = new Usage();
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Save the record to the db
            if ($this->usage->save()) {
                $success = 'Your new usage has been created in the database!';
                //Override to see a new empty form
                $this->usage = new Usage();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the usage';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create usage',
            'usage' => $this->usage,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        try {
            //Get the record from the db & execute POST logic
            $this->usage = Usage::getById($_GET['id']);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->usage->save()) {
                    $success = 'Your usage has been updated in the database!';
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the usage';
                }
            }

            $pageTitle = 'Edit ' . $this->usage->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->usage = new Usage();
            $this->errors[] = 'Whoops: ' . $e->getMessage();
            $pageTitle = 'Usage does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'usage' => $this->usage,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $usage = Usage::getById($_GET['id']);

            //Default page title
            $pageTitle = $usage->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Usage does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'usage' => $usage ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        try {
            //Get the record from the db
            $usage = Usage::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB
                if (Usage::delete((int)$_GET['id'])) {
                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'usages');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete usage',
                'usage' => $usage,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'usages');
            exit;
        }
    }
}
