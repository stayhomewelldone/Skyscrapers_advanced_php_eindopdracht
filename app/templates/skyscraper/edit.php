<?php
/**
 * @var string[] $errors
 * @var string|bool $success
 * @var \Buildings\Databases\Objects\Skyscraper|null $skyscraper
 * @var \Buildings\Databases\Objects\Architect[] $architects
 * @var \Buildings\Databases\Objects\Usage[] $usages
 * @var int[] $usageIds
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

<?php if ($success): ?>
    <p class="notification is-primary"><?= $success; ?></p>
<?php endif; ?>

<?php if (isset($skyscraper)): ?>
    <h1 class="title mt-4">Edit <em><?= $skyscraper->architects_name . ' - ' . $skyscraper->name; ?></em></h1>
    <section class="columns">
        <form class="column is-6" action="" method="post" enctype="multipart/form-data">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="architect-id">architect</label>
                </div>
                <div class="field-body select is-fullwidth">
                    <select name="architect-id" id="architect-id">
                        <?php foreach ($architects as $architect): ?>
                            <option value="<?= $architect->id; ?>" <?= $architect->id === $skyscraper->architect_id ? 'selected' : '' ?>><?= $architect->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="name">skyscraper</label>
                </div>
                <div class="field-body">
                    <input class="input" id="name" type="text" name="name" value="<?= $skyscraper->name; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="usage-ids">usage(s)</label>
                </div>
                <div class="field-body select is-multiple is-fullwidth">
                    <select multiple size="3" name="usage-ids[]" id="usage-ids" title="usages">
                        <?php foreach ($usages as $usage): ?>
                            <option value="<?= $usage->id; ?>" <?= in_array($usage->id, $usageIds) ? 'selected' : '' ?>><?= $usage->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="built_year">built_year</label>
                </div>
                <div class="field-body">
                    <input class="input" id="built_year" type="text" name="built_year" value="<?= $skyscraper->built_year; ?>"/>
                </div>
            </div>
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label" for="floors">floors</label>
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
<?php endif; ?>
<a class="button" href="<?= BASE_PATH; ?>skyscrapers">&laquo; Go back to the list</a>
