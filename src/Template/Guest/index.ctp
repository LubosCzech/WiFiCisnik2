<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Guest'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="guest index large-9 medium-8 columns content">
    <h3><?= __('Guest') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Active') ?></th>
                <th><?= $this->Paginator->sort('Place_ID') ?></th>
                <th><?= $this->Paginator->sort('LastActive') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($guest as $guest): ?>
            <tr>
                <td><?= $this->Number->format($guest->ID) ?></td>
                <td><?= h($guest->Name) ?></td>
                <td><?= h($guest->Code) ?></td>
                <td><?= h($guest->Active) ?></td>
                <td><?= $this->Number->format($guest->Place_ID) ?></td>
                <td><?= h($guest->LastActive) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $guest->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $guest->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $guest->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $guest->ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
