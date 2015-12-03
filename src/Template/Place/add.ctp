<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Place'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="place form large-9 medium-8 columns content">
    <?= $this->Form->create($place) ?>
    <fieldset>
        <legend><?= __('Add Place') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('Checkout_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
