<?php
/**
 * @var string[] $errors
 * @var \Buildings\Databases\Objects\Skyscraper $skyscraper
 */
?>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<h1 class="title mt-4">Are you sure you want to delete skyscraper <em><?= $skyscraper->name; ?></em> from <em><?= $skyscraper->architects_name; ?></em>?</h1>
<a class="button is-danger mt-4" href="<?= BASE_PATH; ?>skyscrapers/delete?id=<?= $skyscraper->id; ?>&continue">Yes, delete!</a>
<a class="button mt-4" href="<?= BASE_PATH; ?>skyscrapers">Go back to the list</a>
