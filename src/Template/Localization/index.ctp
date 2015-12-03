<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Localization'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="localization index large-9 medium-8 columns content">
    <h3><?= __('Localization') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Czech') ?></th>
                <th><?= $this->Paginator->sort('English') ?></th>
                <th><?= $this->Paginator->sort('German') ?></th>
                <th><?= $this->Paginator->sort('Slovak') ?></th>
                <th><?= $this->Paginator->sort('Polish') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($localization as $localization): ?>
            <tr>
                <td><?= $this->Number->format($localization->ID) ?></td>
                <td><?= h($localization->Code) ?></td>
                <td><?= h($localization->Czech) ?></td>
                <td><?= h($localization->English) ?></td>
                <td><?= h($localization->German) ?></td>
                <td><?= h($localization->Slovak) ?></td>
                <td><?= h($localization->Polish) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $localization->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $localization->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $localization->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $localization->ID)]) ?>
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
