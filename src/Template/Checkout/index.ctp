<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="checkout index large-9 medium-8 columns content">
    <h3><?= __('Checkout') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Restaurant_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($checkout as $checkout): ?>
            <tr>
                <td><?= $this->Number->format($checkout->ID) ?></td>
                <td><?= h($checkout->Name) ?></td>
                <td><?= h($checkout->Code) ?></td>
                <td><?= $this->Number->format($checkout->Restaurant_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $checkout->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $checkout->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $checkout->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->ID)]) ?>
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
