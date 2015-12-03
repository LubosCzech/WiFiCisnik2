<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="user form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->input('FullName');
            echo $this->Form->input('Login');
            echo $this->Form->input('Password');
            echo $this->Form->input('Role');
            echo $this->Form->input('Checkout_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
