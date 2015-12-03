<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Product'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="product form large-9 medium-8 columns content">
    <?= $this->Form->create($product) ?>
    <fieldset>
        <legend><?= __('Edit Product') ?></legend>
        <?php
            echo $this->Form->input('Code');
            echo $this->Form->input('Name');
            echo $this->Form->input('Price');
            echo $this->Form->input('Description');
            echo $this->Form->input('ImageUrl');
            echo $this->Form->input('IsOption');
            echo $this->Form->input('Category_ID');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
