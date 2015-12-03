<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Product Option'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="productOption index large-9 medium-8 columns content">
    <h3><?= __('Product Option') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Product_ID') ?></th>
                <th><?= $this->Paginator->sort('Option_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productOption as $productOption): ?>
            <tr>
                <td><?= $this->Number->format($productOption->ID) ?></td>
                <td><?= $this->Number->format($productOption->Product_ID) ?></td>
                <td><?= $this->Number->format($productOption->Option_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $productOption->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productOption->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productOption->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $productOption->ID)]) ?>
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
