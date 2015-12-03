<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderProduct->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderProduct->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Order Product'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Product'), ['controller' => 'Product', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Product'), ['controller' => 'Product', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Order Guest'), ['controller' => 'OrderGuest', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Order Guest'), ['controller' => 'OrderGuest', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="orderProduct form large-9 medium-8 columns content">
    <?= $this->Form->create($orderProduct) ?>
    <fieldset>
        <legend><?= __('Edit Order Product') ?></legend>
        <?php
            echo $this->Form->input('Order_Guest_ID');
            echo $this->Form->input('Product_ID');
            echo $this->Form->input('Quantity');
            echo $this->Form->input('Price');
            echo $this->Form->input('PriceTotal');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
