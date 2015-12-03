<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit News'), ['action' => 'edit', $news->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete News'), ['action' => 'delete', $news->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $news->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List News'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New News'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="news view large-9 medium-8 columns content">
    <h3><?= h($news->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($news->Title) ?></td>
        </tr>
        <tr>
            <th><?= __('Text') ?></th>
            <td><?= h($news->Text) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($news->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant ID') ?></th>
            <td><?= $this->Number->format($news->Restaurant_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($news->Created) ?></tr>
        </tr>
    </table>
</div>
