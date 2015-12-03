<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit State'), ['action' => 'edit', $state->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete State'), ['action' => 'delete', $state->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $state->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="states view large-9 medium-8 columns content">
    <h3><?= h($state->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($state->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($state->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($state->ID) ?></td>
        </tr>
    </table>
</div>
