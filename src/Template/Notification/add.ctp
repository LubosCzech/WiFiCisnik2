<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Notification'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="notification form large-9 medium-8 columns content">
    <?= $this->Form->create($notification) ?>
    <fieldset>
        <legend><?= __('Add Notification') ?></legend>
        <?php
            echo $this->Form->input('Guest_ID');
            echo $this->Form->input('Place_ID');
            echo $this->Form->input('State');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
