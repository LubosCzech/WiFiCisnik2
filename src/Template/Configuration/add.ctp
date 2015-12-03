<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Configuration'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="configuration form large-9 medium-8 columns content">
    <?= $this->Form->create($configuration) ?>
    <fieldset>
        <legend><?= __('Add Configuration') ?></legend>
        <?php
            echo $this->Form->input('Restaurant_ID');
            echo $this->Form->input('CurrencySign');
            echo $this->Form->input('WelcomeText');
            echo $this->Form->input('AdminText');
            echo $this->Form->input('PlaceText');
            echo $this->Form->input('NoteTextHolder');
            echo $this->Form->input('CashEnabled');
            echo $this->Form->input('MPEnabled');
            echo $this->Form->input('GPEnabled');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
