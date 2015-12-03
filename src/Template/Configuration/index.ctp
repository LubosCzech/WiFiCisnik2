<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="configuration index large-9 medium-8 columns content">
    <h3><?= __('Configuration') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Restaurant_ID') ?></th>
                <th><?= $this->Paginator->sort('CurrencySign') ?></th>
                <th><?= $this->Paginator->sort('WelcomeText') ?></th>
                <th><?= $this->Paginator->sort('AdminText') ?></th>
                <th><?= $this->Paginator->sort('PlaceText') ?></th>
                <th><?= $this->Paginator->sort('NoteTextHolder') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($configuration as $configuration): ?>
            <tr>
                <td><?= $this->Number->format($configuration->ID) ?></td>
                <td><?= $this->Number->format($configuration->Restaurant_ID) ?></td>
                <td><?= h($configuration->CurrencySign) ?></td>
                <td><?= h($configuration->WelcomeText) ?></td>
                <td><?= h($configuration->AdminText) ?></td>
                <td><?= h($configuration->PlaceText) ?></td>
                <td><?= h($configuration->NoteTextHolder) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $configuration->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $configuration->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $configuration->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $configuration->ID)]) ?>
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
