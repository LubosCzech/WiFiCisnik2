<table cellpadding="0" cellspacing="0" class="uk-table uk-table-striped uk-text-extralarge uk-height-1-1">
    <thead>
    <tr>
        <th>Jméno</th>
        <th>Komentář</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($rating as $rating): ?>
        <tr>
            <td><?= h($rating->Guest_Name) ?></td>
            <td><?= h($rating->Comment) ?></td>
            <td><?= $this->Number->format($rating->Question1) ?></td>
            <td><?= $this->Number->format($rating->Question2) ?></td>
            <td><?= $this->Number->format($rating->Question3) ?></td>
            <td><?= $this->Number->format($rating->Question4) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>