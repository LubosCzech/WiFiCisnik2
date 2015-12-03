<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Restaurant'), ['action' => 'edit', $restaurant->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Restaurant'), ['action' => 'delete', $restaurant->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Restaurant'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Restaurant'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="restaurant view large-9 medium-8 columns content">
    <h3><?= h($restaurant->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($restaurant->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($restaurant->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('LogoUrl') ?></th>
            <td><?= h($restaurant->LogoUrl) ?></td>
        </tr>
        <tr>
            <th><?= __('WebUrl') ?></th>
            <td><?= h($restaurant->WebUrl) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($restaurant->ID) ?></td>
        </tr>
    </table>
</div>
