<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Place'), ['action' => 'edit', $place->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Place'), ['action' => 'delete', $place->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $place->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Place'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Place'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="place view large-9 medium-8 columns content">
    <h3><?= h($place->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($place->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($place->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($place->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Checkout ID') ?></th>
            <td><?= $this->Number->format($place->Checkout_ID) ?></td>
        </tr>
    </table>
</div>
