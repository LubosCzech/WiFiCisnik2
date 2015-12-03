<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Note'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="note form large-9 medium-8 columns content">
    <?= $this->Form->create($note) ?>
    <fieldset>
        <legend><?= __('Add Note') ?></legend>
        <?php
            echo $this->Form->input('OrderGuest_ID');
            echo $this->Form->input('Text');
            echo $this->Form->input('Guest_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
