<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $news->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $news->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List News'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="news form large-9 medium-8 columns content">
    <?= $this->Form->create($news) ?>
    <fieldset>
        <legend><?= __('Edit News') ?></legend>
        <?php
            echo $this->Form->input('Title');
            echo $this->Form->input('Text');
            echo $this->Form->input('Created');
            echo $this->Form->input('Restaurant_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
