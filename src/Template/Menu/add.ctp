<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Menu'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="menu form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Add Menu') ?></legend>
        <?php
            echo $this->Form->input('Restaurant_ID');
            echo $this->Form->input('Category_ID');
            echo $this->Form->input('Product_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
