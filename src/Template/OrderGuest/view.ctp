<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Order Guest'), ['action' => 'edit', $orderGuest->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Order Guest'), ['action' => 'delete', $orderGuest->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderGuest->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Order Guest'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Order Guest'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="orderGuest view large-9 medium-8 columns content">
    <h3><?= h($orderGuest->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($orderGuest->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('PaymentState') ?></th>
            <td><?= $this->Number->format($orderGuest->PaymentState) ?></td>
        </tr>
        <tr>
            <th><?= __('OrderState') ?></th>
            <td><?= $this->Number->format($orderGuest->OrderState) ?></td>
        </tr>
        <tr>
            <th><?= __('Guest ID') ?></th>
            <td><?= $this->Number->format($orderGuest->Guest_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Place ID') ?></th>
            <td><?= $this->Number->format($orderGuest->Place_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Payment ID') ?></th>
            <td><?= $this->Number->format($orderGuest->Payment_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('User ID') ?></th>
            <td><?= $this->Number->format($orderGuest->User_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('TotalPrice') ?></th>
            <td><?= $this->Number->format($orderGuest->TotalPrice) ?></td>
        </tr>
        <tr>
            <th><?= __('OrderMain ID') ?></th>
            <td><?= $this->Number->format($orderGuest->OrderMain_ID) ?></td>
        </tr>
    </table>
</div>
