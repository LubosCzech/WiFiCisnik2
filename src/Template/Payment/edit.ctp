<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $payment->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $payment->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Payment'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="payment form large-9 medium-8 columns content">
    <?= $this->Form->create($payment) ?>
    <fieldset>
        <legend><?= __('Edit Payment') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('Type');
            echo $this->Form->input('Gratuity');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
