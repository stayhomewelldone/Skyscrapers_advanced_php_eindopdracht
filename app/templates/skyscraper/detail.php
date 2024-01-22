<?php
/**
 * @var string[] $errors
 * @var \Buildings\Databases\Objects\Skyscraper|null $skyscraper
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

<?php if (isset($skyscraper)): ?>
    <h1 class="title mt-4"><?= $skyscraper->architects_name . ' - ' . $skyscraper->name; ?></h1>
    <img class="image is-128x128" src="<?= BASE_PATH; ?>images/<?= $skyscraper->image; ?>" alt="<?= $skyscraper->name; ?>"/>
    <section class="content">
        <ul>
            <li>Usage(s): <?= implode(', ', $skyscraper->getUsages()); ?></li>
            <li>Built year: <?= $skyscraper->built_year; ?></li>
            <li>Floors: <?= $skyscraper->floors; ?></li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>skyscrapers">Go back to the list</a>
