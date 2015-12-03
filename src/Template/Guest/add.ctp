<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Guest'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="guest form large-9 medium-8 columns content">
    <?= $this->Form->create($guest) ?>
    <fieldset>
        <legend><?= __('Add Guest') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('Active');
            echo $this->Form->input('Place_ID');
            echo $this->Form->input('LastActive');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
