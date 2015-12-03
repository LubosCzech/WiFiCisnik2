<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $state->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $state->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List States'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="states form large-9 medium-8 columns content">
    <?= $this->Form->create($state) ?>
    <fieldset>
        <legend><?= __('Edit State') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
