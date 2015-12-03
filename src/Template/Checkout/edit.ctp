<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $checkout->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $checkout->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Checkout'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="checkout form large-9 medium-8 columns content">
    <?= $this->Form->create($checkout) ?>
    <fieldset>
        <legend><?= __('Edit Checkout') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('Restaurant_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
