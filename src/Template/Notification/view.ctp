<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Notification'), ['action' => 'edit', $notification->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Notification'), ['action' => 'delete', $notification->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Notification'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="notification view large-9 medium-8 columns content">
    <h3><?= h($notification->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($notification->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Guest ID') ?></th>
            <td><?= $this->Number->format($notification->Guest_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Place ID') ?></th>
            <td><?= $this->Number->format($notification->Place_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('State') ?></th>
            <td><?= $this->Number->format($notification->State) ?></td>
        </tr>
    </table>
</div>
