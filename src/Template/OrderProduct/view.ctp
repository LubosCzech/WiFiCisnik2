<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Product'), ['action' => 'edit', $orderProduct->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Product'), ['action' => 'delete', $orderProduct->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderProduct->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Product'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Product'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Order Guest'), ['controller' => 'OrderGuest', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Guest'), ['controller' => 'OrderGuest', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderProduct view large-9 medium-8 columns content">
    <h3><?= h($orderProduct->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($orderProduct->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Order Guest ID') ?></th>
            <td><?= $this->Number->format($orderProduct->Order_Guest_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Product ID') ?></th>
            <td><?= $this->Number->format($orderProduct->Product_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Quantity') ?></th>
            <td><?= $this->Number->format($orderProduct->Quantity) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($orderProduct->Price) ?></td>
        </tr>
        <tr>
            <th><?= __('PriceTotal') ?></th>
            <td><?= $this->Number->format($orderProduct->PriceTotal) ?></td>
        </tr>
    </table>
</div>
