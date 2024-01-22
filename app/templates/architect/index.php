<?php
/**
 * @var array $errors
 * @var int $totalArchitects
 * @var \Buildings\Databases\Objects\Architect[] $architects
 */
?>
<h1 class="title mt-4">Architects</h1>
<?php if (!empty($errors)): ?>
    <section class="content">
        <ul class="notification is-danger">
            <?php foreach ($errors as $error): ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>

<a class="button is-link is-rounded is-light" href="<?= BASE_PATH; ?>">&laquo; Back home</a>
<button  type="submit" class=" button is rounded is-focused " ><a href="<?= BASE_PATH; ?>architects/create">Create new architect</a></button>
<table class="table is-striped mt-4">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Total Skyscrapers</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="6" class="has-text-centered">&copy; My Collection with <?= $totalArchitects; ?> architects</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($architects as $architect): ?>
        <tr>
            <td><?= $architect->id; ?></td>
            <td><?= $architect->name; ?></td>
            <td><?= count($architect->skyscrapers()); ?></td>
            <td><a href="<?= BASE_PATH; ?>architects/detail?id=<?= $architect->id; ?>">Details</a></td>
            <td><a href="<?= BASE_PATH; ?>architects/edit?id=<?= $architect->id; ?>">Edit</a></td>
            <td><a href="<?= BASE_PATH; ?>architects/delete?id=<?= $architect->id; ?>">Delete</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
