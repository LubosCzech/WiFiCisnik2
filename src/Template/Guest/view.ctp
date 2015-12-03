<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Guest'), ['action' => 'edit', $guest->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Guest'), ['action' => 'delete', $guest->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $guest->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Guest'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Guest'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="guest view large-9 medium-8 columns content">
    <h3><?= h($guest->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($guest->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($guest->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($guest->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Place ID') ?></th>
            <td><?= $this->Number->format($guest->Place_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('LastActive') ?></th>
            <td><?= h($guest->LastActive) ?></tr>
        </tr>
        <tr>
            <th><?= __('Active') ?></th>
            <td><?= $guest->Active ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
