<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $orderGuest->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $orderGuest->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Order Guest'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="orderGuest form large-9 medium-8 columns content">
    <?= $this->Form->create($orderGuest) ?>
    <fieldset>
        <legend><?= __('Edit Order Guest') ?></legend>
        <?php
            echo $this->Form->input('PaymentState');
            echo $this->Form->input('OrderState');
            echo $this->Form->input('Guest_ID');
            echo $this->Form->input('Place_ID');
            echo $this->Form->input('Payment_ID');
            echo $this->Form->input('User_ID');
            echo $this->Form->input('TotalPrice');
            echo $this->Form->input('OrderMain_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
