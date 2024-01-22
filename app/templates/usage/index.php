<?php
/**
 * @var array $errors
 * @var int $totalUsages
 * @var \Buildings\Databases\Objects\Usage[] $usages
 */
?>
<h1 class="title mt-4">Usages</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<a class="button is-link is-rounded is-light is-focused" href="<?= BASE_PATH; ?>">&laquo; Back home</a>
<a class="button is-rounded" href="<?= BASE_PATH; ?>usages/create">Create new usage</a>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Total Usages</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6" class="has-text-centered">&copy; My Collection with <?= $totalUsages; ?> usages</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($usages as $usage): ?>
        <tr>
            <td><?= $usage->id; ?></td>
            <td><?= $usage->name; ?></td>
            <td><?= count($usage->skyscrapers()); ?></td>
            <td><a href="<?= BASE_PATH; ?>usages/detail?id=<?= $usage->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>usages/edit?id=<?= $usage->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>usages/delete?id=<?= $usage->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
