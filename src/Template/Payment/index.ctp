<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="payment index large-9 medium-8 columns content">
    <h3><?= __('Payment') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Type') ?></th>
                <th><?= $this->Paginator->sort('Gratuity') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($payment as $payment): ?>
            <tr>
                <td><?= $this->Number->format($payment->ID) ?></td>
                <td><?= h($payment->Name) ?></td>
                <td><?= h($payment->Code) ?></td>
                <td><?= $this->Number->format($payment->Type) ?></td>
                <td><?= h($payment->Gratuity) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $payment->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $payment->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $payment->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->ID)]) ?>
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
