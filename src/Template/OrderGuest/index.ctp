<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Guest'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderGuest index large-9 medium-8 columns content">
    <h3><?= __('Order Guest') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('PaymentState') ?></th>
                <th><?= $this->Paginator->sort('OrderState') ?></th>
                <th><?= $this->Paginator->sort('Guest_ID') ?></th>
                <th><?= $this->Paginator->sort('Place_ID') ?></th>
                <th><?= $this->Paginator->sort('Payment_ID') ?></th>
                <th><?= $this->Paginator->sort('User_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderGuest as $orderGuest): ?>
            <tr>
                <td><?= $this->Number->format($orderGuest->ID) ?></td>
                <td><?= $this->Number->format($orderGuest->PaymentState) ?></td>
                <td><?= $this->Number->format($orderGuest->OrderState) ?></td>
                <td><?= $this->Number->format($orderGuest->Guest_ID) ?></td>
                <td><?= $this->Number->format($orderGuest->Place_ID) ?></td>
                <td><?= $this->Number->format($orderGuest->Payment_ID) ?></td>
                <td><?= $this->Number->format($orderGuest->User_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderGuest->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderGuest->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderGuest->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderGuest->ID)]) ?>
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
