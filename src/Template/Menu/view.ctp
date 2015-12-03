<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Menu'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menu view large-9 medium-8 columns content">
    <h3><?= h($menu->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($menu->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant ID') ?></th>
            <td><?= $this->Number->format($menu->Restaurant_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Category ID') ?></th>
            <td><?= $this->Number->format($menu->Category_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Product ID') ?></th>
            <td><?= $this->Number->format($menu->Product_ID) ?></td>
        </tr>
    </table>
</div>
