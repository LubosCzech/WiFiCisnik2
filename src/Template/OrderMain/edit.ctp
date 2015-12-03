<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderMain->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderMain->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Order Main'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="orderMain form large-9 medium-8 columns content">
    <?= $this->Form->create($orderMain) ?>
    <fieldset>
        <legend><?= __('Edit Order Main') ?></legend>
        <?php
            echo $this->Form->input('OrderState');
            echo $this->Form->input('OrdersCount');
            echo $this->Form->input('Place_ID');
            echo $this->Form->input('User_ID');
            echo $this->Form->input('Created');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
