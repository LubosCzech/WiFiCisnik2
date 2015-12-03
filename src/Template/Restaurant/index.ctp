<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Restaurant'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="restaurant index large-9 medium-8 columns content">
    <h3><?= __('Restaurant') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('LogoUrl') ?></th>
                <th><?= $this->Paginator->sort('WebUrl') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurant as $restaurant): ?>
            <tr>
                <td><?= $this->Number->format($restaurant->ID) ?></td>
                <td><?= h($restaurant->Name) ?></td>
                <td><?= h($restaurant->Code) ?></td>
                <td><?= h($restaurant->LogoUrl) ?></td>
                <td><?= h($restaurant->WebUrl) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $restaurant->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurant->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurant->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->ID)]) ?>
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
