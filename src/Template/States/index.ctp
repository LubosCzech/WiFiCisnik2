<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New State'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="states index large-9 medium-8 columns content">
    <h3><?= __('States') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($states as $state): ?>
            <tr>
                <td><?= $this->Number->format($state->ID) ?></td>
                <td><?= h($state->Name) ?></td>
                <td><?= h($state->Code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $state->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $state->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $state->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $state->ID)]) ?>
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
