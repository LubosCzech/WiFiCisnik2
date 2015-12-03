<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Rating'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="rating form large-9 medium-8 columns content">
    <?= $this->Form->create($rating) ?>
    <fieldset>
        <legend><?= __('Add Rating') ?></legend>
        <?php
            echo $this->Form->input('Guest_Name');
            echo $this->Form->input('Comment');
            echo $this->Form->input('Question1');
            echo $this->Form->input('Question2');
            echo $this->Form->input('Question3');
            echo $this->Form->input('Question4');
            echo $this->Form->input('Question5');
            echo $this->Form->input('Guest_ID');
            echo $this->Form->input('Restaurant_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
