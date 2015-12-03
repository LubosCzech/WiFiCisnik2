<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Main'), ['action' => 'edit', $orderMain->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Main'), ['action' => 'delete', $orderMain->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderMain->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Main'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Main'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderMain view large-9 medium-8 columns content">
    <h3><?= h($orderMain->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($orderMain->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('OrderState') ?></th>
            <td><?= $this->Number->format($orderMain->OrderState) ?></td>
        </tr>
        <tr>
            <th><?= __('OrdersCount') ?></th>
            <td><?= $this->Number->format($orderMain->OrdersCount) ?></td>
        </tr>
        <tr>
            <th><?= __('Place ID') ?></th>
            <td><?= $this->Number->format($orderMain->Place_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('User ID') ?></th>
            <td><?= $this->Number->format($orderMain->User_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($orderMain->Created) ?></tr>
        </tr>
    </table>
</div>
