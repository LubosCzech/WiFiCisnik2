<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Product Option'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="productOption form large-9 medium-8 columns content">
    <?= $this->Form->create($productOption) ?>
    <fieldset>
        <legend><?= __('Add Product Option') ?></legend>
        <?php
            echo $this->Form->input('Product_ID');
            echo $this->Form->input('Option_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
