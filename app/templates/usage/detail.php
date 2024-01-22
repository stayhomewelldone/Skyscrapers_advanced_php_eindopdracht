<?php
/**
 * @var array $errors
 * @var \Buildings\Databases\Objects\Usage|null $usage
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

<?php if (isset($usage)): ?>
    <h1 class="title mt-4"><?= $usage->name; ?></h1>
    <section class="content">
        <ul>
            <li>Usages:
                <ul>
                    <?php foreach ($usage->skyscrapers() as $skyscraper): ?>
                        <li><?= $skyscraper->name; ?></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        </ul>
    </section>
<?php endif; ?>
<a class="button mt-4" href="<?= BASE_PATH; ?>usages">Go back to the list</a>
