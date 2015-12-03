<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $category->ID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $category->ID)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Category'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="category form large-9 medium-8 columns content">
    <?= $this->Form->create($category) ?>
    <fieldset>
        <legend><?= __('Edit Category') ?></legend>
        <?php
            echo $this->Form->input('Code');
            echo $this->Form->input('Name');
            echo $this->Form->input('ImageUrl');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
