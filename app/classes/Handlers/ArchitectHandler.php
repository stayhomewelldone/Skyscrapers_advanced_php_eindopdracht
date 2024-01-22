<?php

namespace Buildings\Handlers;

use Buildings\Databases\Objects\Architect;

/**
 * Class ArchitectHandler
 * @package Buildings\Handlers
 * @noinspection PhpUnused
 */
class ArchitectHandler extends BaseHandler
{
    use FillAndValidate\Architect;

    private Architect $architect;

    protected function index(): void
    {
        //Get all architects
        $architects = Architect::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Architects',
            'architects' => $architects,
            'totalArchitects' => count($architects)
        ]);
    }

    protected function create(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=architects/create');
            exit;
        }

        //Set default empty architect & execute POST logic
        $this->architect = new Architect();
        $this->executePostHandler();

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Set user id in Architect
            $this->architect->user_id = $this->session->get('user')->id;

            //Save the record to the db
            if ($this->architect->save()) {
                $success = 'Your new architect has been created in the database!';
                //Override to see a new empty form
                $this->architect = new Architect();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the architect';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create architect',
            'architect' => $this->architect,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        try {
            //Get the record from the db & execute POST logic
            $this->architect = Architect::getById($_GET['id']);
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //Save the record to the db
                if ($this->architect->save()) {
                    $success = 'Your architect has been updated in the database!';
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the architect';
                }
            }

            $pageTitle = 'Edit ' . $this->architect->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->architect = new Architect();
            $this->errors[] = 'Whoops: ' . $e->getMessage();
            $pageTitle = 'Architect does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'architect' => $this->architect,
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
            $architect = Architect::getById($_GET['id']);

            //Default page title
            $pageTitle = $architect->name;
        } catch (\Exception $e) {
            //Something went wrong on this level
            $this->errors[] = $e->getMessage();
            $pageTitle = 'Architect does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'architect' => $architect ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        try {
            //Get the record from the db
            $architect = Architect::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB, and if successful remove image as well
                if (Architect::delete((int)$_GET['id'])) {
                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'architects');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete architect',
                'architect' => $architect,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //There is no delete template, always redirect.
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'architects');
            exit;
        }
    }
}
