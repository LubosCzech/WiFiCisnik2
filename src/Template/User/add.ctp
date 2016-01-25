<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Checkout'), ['controller' => 'Checkout', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Checkout'), ['controller' => 'Checkout', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->input('FullName');
            echo $this->Form->input('Login');
            echo $this->Form->input('Password');
            echo $this->Form->input('Role');
            echo $this->Form->input('Checkout_ID');
            echo $this->Form->input('Restaurant_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
