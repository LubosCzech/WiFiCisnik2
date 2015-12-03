<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $localization->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $localization->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Localization'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="localization form large-9 medium-8 columns content">
    <?= $this->Form->create($localization) ?>
    <fieldset>
        <legend><?= __('Edit Localization') ?></legend>
        <?php
            echo $this->Form->input('Code');
            echo $this->Form->input('Czech');
            echo $this->Form->input('English');
            echo $this->Form->input('German');
            echo $this->Form->input('Slovak');
            echo $this->Form->input('Polish');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
