<?php

namespace Buildings\Handlers;

use Buildings\Databases\Objects\Architect;
use Buildings\Databases\Objects\Usage;
use Buildings\Form\Data;
use Buildings\Databases\Objects\Skyscraper;
use Buildings\Utils\Image;

/**
 * Class SkyscraperHandler
 * @package Buildings\Handlers
 * @noinspection PhpUnused
 */
class SkyscraperHandler extends BaseHandler
{
    use FillAndValidate\Skyscraper;

    private Skyscraper $skyscraper;
    private Data $formData;
    private Image $image;

    /**
     * SkyscraperHandler constructor.
     *
     * @param string $templateName
     * @throws \ReflectionException
     */
    public function __construct(string $templateName)
    {
        parent::__construct($templateName);
        $this->image = new Image();
    }

    protected function index(): void
    {
        //Get all skyscrapers
        $skyscrapers = Skyscraper::getAll();

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Home',
            'skyscrapers' => $skyscrapers,
            'totalSkyscrapers' => count($skyscrapers)
        ]);
    }

    protected function create(): void
    {
        //If not logged in, redirect to login
        if (!$this->session->keyExists('user')) {
            header('Location: ' . BASE_PATH . 'user/login?location=skyscrapers/create');
            exit;
        }

        //Set default empty skyscraper & execute POST logic
        $this->skyscraper = new Skyscraper();
        $this->executePostHandler();

        //Special check for create form only
        if (isset($this->formData) && $_FILES['image']['error'] == 4) {
            $this->errors[] = 'Image cannot be empty';
        }

        //Database magic when no errors are found
        if (isset($this->formData) && empty($this->errors)) {
            //Store image & retrieve name for database saving
            $this->skyscraper->image = $this->image->save($_FILES['image']);

            //Set user id in skyscraper
            $this->skyscraper->user_id = $this->session->get('user')->id;

            //Save the record to the db
            if ($this->skyscraper->save()) {
                if ($this->skyscraper->saveUsages()) {
                    $success = 'Your new skyscraper has been created in the database!';
                } else {
                    Skyscraper::delete($this->skyscraper->id);
                }
                //Override to see a new empty form
                $this->skyscraper = new Skyscraper();
            } else {
                $this->errors[] = 'Whoops, something went wrong creating the skyscraper';
            }
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => 'Create skyscraper',
            'skyscraper' => $this->skyscraper,
            'architects' => Architect::getAll(),
            'usages' => Usage::getAll(),
            'usageIds' => $this->skyscraper->getUsageIds(),
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function edit(): void
    {
        try {
            //Get the record from the db & execute POST logic
            $this->skyscraper = Skyscraper::getById((int)$_GET['id']);
            $this->skyscraper->setUsageIds(array_map(fn (Usage $usage) => $usage->id, $this->skyscraper->getUsages()));
            $this->executePostHandler();

            //Database magic when no errors are found
            if (isset($this->formData) && empty($this->errors)) {
                //If image is not empty, process the new image file
                if ($_FILES['image']['error'] != 4) {
                    //Remove old image
                    $this->image->delete($this->skyscraper->image);

                    //Store new image & retrieve name for database saving (override current image name)
                    $this->skyscraper->image = $this->image->save($_FILES['image']);
                }

                //Save the record to the db
                if ($this->skyscraper->save()) {
                    if ($this->skyscraper->saveUsages()) {
                        $success = 'Your skyscraper has been updated in the database!';
                    } else {
                        $this->errors[] = 'Whoops, something went wrong updating the usages of the skyscraper';
                    }
                } else {
                    $this->errors[] = 'Whoops, something went wrong updating the skyscraper';
                }
            }

            $pageTitle = 'Edit ' . $this->skyscraper->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the skyscraper as it doesn\'t seem to exist.';
            $pageTitle = 'skyscraper does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'skyscraper' => $this->skyscraper ?? null,
            'architects' => Architect::getAll(),
            'usages' => Usage::getAll(),
            'usageIds' => $this->skyscraper->getUsageIds(),
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);
    }

    /**
     * @noinspection PhpUnused
     *
     * @return void
     */
    protected function detail(): void
    {
        try {
            //Get the records from the db
            $skyscraper = Skyscraper::getById((int)$_GET['id']);

            //Default page title
            $pageTitle = $skyscraper->name;
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = 'Something went wrong retrieving the skyscraper as it doesn\'t seem to exist.';
            $pageTitle = 'skyscraper does\'t exist';
        }

        //Return formatted data
        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'skyscraper' => $skyscraper ?? null,
            'errors' => $this->errors
        ]);
    }

    protected function delete(): void
    {
        try {
            //Get the record from the db
            $skyscraper = Skyscraper::getById($_GET['id']);

            //Only execute delete when confirmed
            if (isset($_GET['continue'])) {
                //Delete in the DB, and if successful remove image as well
                if (Skyscraper::delete((int)$_GET['id'])) {
                    //Remove image
                    $this->image->delete($skyscraper->image);

                    //Redirect to homepage after deletion & exit script
                    header('Location: ' . BASE_PATH . 'skyscrapers');
                    exit;
                }
            }

            //Return formatted data
            $this->renderTemplate([
                'pageTitle' => 'Delete skyscraper',
                'skyscraper' => $skyscraper,
                'errors' => $this->errors
            ]);
        } catch (\Exception $e) {
            //We don't want anyone sniffing the delete page for no reason, so without correct parameters, return back
            $this->logger->error($e);
            header('Location: ' . BASE_PATH . 'skyscrapers');
            exit;
        }
    }
}
