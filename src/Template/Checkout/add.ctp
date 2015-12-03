<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Checkout'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="checkout form large-9 medium-8 columns content">
    <?= $this->Form->create($checkout) ?>
    <fieldset>
        <legend><?= __('Add Checkout') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('Restaurant_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
