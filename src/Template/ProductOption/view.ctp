<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product Option'), ['action' => 'edit', $productOption->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product Option'), ['action' => 'delete', $productOption->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $productOption->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Product Option'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product Option'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="productOption view large-9 medium-8 columns content">
    <h3><?= h($productOption->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($productOption->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Product ID') ?></th>
            <td><?= $this->Number->format($productOption->Product_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Option ID') ?></th>
            <td><?= $this->Number->format($productOption->Option_ID) ?></td>
        </tr>
    </table>
</div>
