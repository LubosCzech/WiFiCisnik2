<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $product->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Product'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="product view large-9 medium-8 columns content">
    <h3><?= h($product->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($product->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($product->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($product->Description) ?></td>
        </tr>
        <tr>
            <th><?= __('ImageUrl') ?></th>
            <td><?= h($product->ImageUrl) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($product->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($product->Price) ?></td>
        </tr>
        <tr>
            <th><?= __('Category ID') ?></th>
            <td><?= $this->Number->format($product->Category_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('IsOption') ?></th>
            <td><?= $product->IsOption ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
