<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $category->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Category'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="category view large-9 medium-8 columns content">
    <h3><?= h($category->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($category->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($category->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('ImageUrl') ?></th>
            <td><?= h($category->ImageUrl) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($category->ID) ?></td>
        </tr>
    </table>
</div>
