<?php
/**
 * @var string[] $errors
 * @var int $totalSkyscrapers
 * @var Buildings\Databases\Objects\Skyscraper[] $skyscrapers
 */
?>
<h1 class="title mt-4">Skyscrapers</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<a class="button is-link is-rounded is-focused is-light" href="<?= BASE_PATH; ?>">&laquo; Back home</a>
<a class="button is-rounded" href="<?= BASE_PATH; ?>skyscrapers/create">Create new skyscraper</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th></th>
        <th>#</th>
        <th>Architect</th>
        <th>Skyscraper</th>
        <th>Usage(s)</th>
        <th>Built Year</th>
        <th>Floors</th>
        <th colspan=3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10" class="has-text-centered">&copy; My Collection with <?= $totalSkyscrapers; ?> skyscrapers</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($skyscrapers as $skyscraper): ?>
        <tr>
            <td class="is-vcentered">
                <img class="image is-64x64" src="images/<?= $skyscraper->image; ?>" alt="<?= $skyscraper->name; ?>"/>
            </td>
            <td class="is-vcentered"><?= $skyscraper->id; ?></td>
            <td class="is-vcentered"><?= $skyscraper->architects_name; ?></td>
            <td class="is-vcentered"><?= $skyscraper->name; ?></td>
            <td class="is-vcentered"><?= implode(', ', $skyscraper->getUsages()); ?></td>
            <td class="is-vcentered"><?= $skyscraper->built_year; ?></td>
            <td class="is-vcentered"><?= $skyscraper->floors; ?></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>skyscrapers/detail?id=<?= $skyscraper->id; ?>">Details</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>skyscrapers/edit?id=<?= $skyscraper->id; ?>">Edit</a></td>
            <td class="is-vcentered"><a href="<?= BASE_PATH; ?>skyscrapers/delete?id=<?= $skyscraper->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
