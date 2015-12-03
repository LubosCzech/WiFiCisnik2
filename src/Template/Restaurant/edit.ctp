<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $restaurant->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Restaurant'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="restaurant form large-9 medium-8 columns content">
    <?= $this->Form->create($restaurant) ?>
    <fieldset>
        <legend><?= __('Edit Restaurant') ?></legend>
        <?php
            echo $this->Form->input('Name');
            echo $this->Form->input('Code');
            echo $this->Form->input('LogoUrl');
            echo $this->Form->input('WebUrl');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
