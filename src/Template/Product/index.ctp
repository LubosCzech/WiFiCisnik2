<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="product index large-9 medium-8 columns content">
    <h3><?= __('Product') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Code') ?></th>
                <th><?= $this->Paginator->sort('Name') ?></th>
                <th><?= $this->Paginator->sort('Price') ?></th>
                <th><?= $this->Paginator->sort('Description') ?></th>
                <th><?= $this->Paginator->sort('ImageUrl') ?></th>
                <th><?= $this->Paginator->sort('IsOption') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $product): ?>
            <tr>
                <td><?= $this->Number->format($product->ID) ?></td>
                <td><?= h($product->Code) ?></td>
                <td><?= h($product->Name) ?></td>
                <td><?= $this->Number->format($product->Price) ?></td>
                <td><?= h($product->Description) ?></td>
                <td><?= h($product->ImageUrl) ?></td>
                <td><?= h($product->IsOption) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $product->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $product->ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
