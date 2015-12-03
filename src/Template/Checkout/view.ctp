<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Checkout'), ['action' => 'edit', $checkout->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Checkout'), ['action' => 'delete', $checkout->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Checkout'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Checkout'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="checkout view large-9 medium-8 columns content">
    <h3><?= h($checkout->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($checkout->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($checkout->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($checkout->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant ID') ?></th>
            <td><?= $this->Number->format($checkout->Restaurant_ID) ?></td>
        </tr>
    </table>
</div>
