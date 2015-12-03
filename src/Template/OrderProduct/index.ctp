<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Product'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Guest'), ['controller' => 'OrderGuest', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Guest'), ['controller' => 'OrderGuest', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderProduct index large-9 medium-8 columns content">
    <h3><?= __('Order Product') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Order_Guest_ID') ?></th>
                <th><?= $this->Paginator->sort('Product_ID') ?></th>
                <th><?= $this->Paginator->sort('Quantity') ?></th>
                <th><?= $this->Paginator->sort('Price') ?></th>
                <th><?= $this->Paginator->sort('PriceTotal') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderProduct as $orderProduct): ?>
            <tr>
                <td><?= $this->Number->format($orderProduct->ID) ?></td>
                <td><?= $this->Number->format($orderProduct->Order_Guest_ID) ?></td>
                <td><?= $this->Number->format($orderProduct->Product_ID) ?></td>
                <td><?= $this->Number->format($orderProduct->Quantity) ?></td>
                <td><?= $this->Number->format($orderProduct->Price) ?></td>
                <td><?= $this->Number->format($orderProduct->PriceTotal) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderProduct->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderProduct->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderProduct->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderProduct->ID)]) ?>
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
