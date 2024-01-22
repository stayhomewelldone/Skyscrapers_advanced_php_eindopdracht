<?php
/**
 * @var string[] $errors
 * @var string|bool $success
 * @var \Buildings\Databases\Objects\Skyscraper $skyscraper
 * @var \Buildings\Databases\Objects\Architect[] $architects
 * @var \Buildings\Databases\Objects\Usage[] $usages
 * @var int[] $usageIds
 */
?>
<h1 class="title mt-4">Create skyscraper</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<?php if ($success) { ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php } ?>

<section class="columns">
    <form class="column is-6" action="" method="post" enctype="multipart/form-data">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="architect">Architect</label>
            </div>

            <div class="field-body select is-fullwidth">
                <select  name="architect-id" id="architect-id" title="Architect">
                    <?php foreach ($architects as $architect): ?>
                        <option value="<?= $architect->id; ?>" <?= $architect->id === $skyscraper->architect_id ? 'selected' : '' ?>><?= $architect->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="name">Name</label>
            </div>
            <div class="field-body">
                <input class="input" id="name" type="text" name="name" value="<?= $skyscraper->name; ?>"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="usage-ids">Usage(s)</label>
            </div>
            <div class="field-body select is-multiple is-fullwidth">
                <select multiple size="3" name="usage-ids[]" id="usage-ids" title="Usages">
                    <?php foreach ($usages as $usage): ?>
                        <option value="<?= $usage->id; ?>" <?= in_array($usage->id, $usageIds) ? 'selected' : '' ?>><?= $usage->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="year">Built Year</label>
            </div>
            <div class="field-body">
                <input class="input" id="built_year" type="text" name="built_year" value="<?= $skyscraper->built_year; ?>"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="floors">Floors</label>
            </div>
            <div class="field-body">
                <input class="input" id="floors" type="number" name="floors" value="<?= $skyscraper->floors; ?>"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="image">Image</label>
            </div>
            <div class="field-body">
                <input class="input" id="image" type="file" name="image"/>
            </div>
        </div>
        <div class="field is-horizontal">
            <div class="field-label is-normal"></div>
            <div class="field-body">
                <button class="button is-primary is-fullwidth" type="submit" name="submit">Save</button>
            </div>
        </div>
    </form>
</section>
<a class="button mt-4" href="<?= BASE_PATH; ?>skyscrapers">&laquo; Go back to the list</a>
<a class="button mt-4 is-danger" href="<?= BASE_PATH; ?>user/logout">Logout</a>
