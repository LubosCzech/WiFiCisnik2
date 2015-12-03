<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Order Main'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderMain index large-9 medium-8 columns content">
    <h3><?= __('Order Main') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Stav') ?></th>
                <th><?= $this->Paginator->sort('Místo') ?></th>
                <th><?= $this->Paginator->sort('Číšník') ?></th>
                <th><?= $this->Paginator->sort('Vytvořeno') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderMain as $orderMain): ?>
            <tr>
                <td><?= $this->Number->format($orderMain->ID) ?></td>
                <td><?= $this->Number->format($orderMain->OrderState) ?></td>
                <td><?= $this->Number->format($orderMain->Place_ID) ?></td>
                <td><?= $this->Number->format($orderMain->User_ID) ?></td>
                <td><?= h($orderMain->Created) ?></td>
                <td class="actions">
                    <a href="#modal_order"
                       id="product_link"
                       class="uk-text-large"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?=$orderMain->ID?>"

                        >Show</a>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $orderMain->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderMain->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderMain->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderMain->ID)]) ?>
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