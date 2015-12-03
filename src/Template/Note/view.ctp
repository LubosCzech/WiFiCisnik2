<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Note'), ['action' => 'edit', $note->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Note'), ['action' => 'delete', $note->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $note->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Note'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Note'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="note view large-9 medium-8 columns content">
    <h3><?= h($note->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($note->Text) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($note->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('OrderGuest ID') ?></th>
            <td><?= $this->Number->format($note->OrderGuest_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Guest ID') ?></th>
            <td><?= $this->Number->format($note->Guest_ID) ?></td>
        </tr>
    </table>
</div>
