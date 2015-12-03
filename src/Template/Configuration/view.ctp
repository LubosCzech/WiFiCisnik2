<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Configuration'), ['action' => 'edit', $configuration->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Configuration'), ['action' => 'delete', $configuration->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $configuration->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Configuration'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Configuration'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="configuration view large-9 medium-8 columns content">
    <h3><?= h($configuration->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('CurrencySign') ?></th>
            <td><?= h($configuration->CurrencySign) ?></td>
        </tr>
        <tr>
            <th><?= __('WelcomeText') ?></th>
            <td><?= h($configuration->WelcomeText) ?></td>
        </tr>
        <tr>
            <th><?= __('AdminText') ?></th>
            <td><?= h($configuration->AdminText) ?></td>
        </tr>
        <tr>
            <th><?= __('PlaceText') ?></th>
            <td><?= h($configuration->PlaceText) ?></td>
        </tr>
        <tr>
            <th><?= __('NoteTextHolder') ?></th>
            <td><?= h($configuration->NoteTextHolder) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($configuration->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant ID') ?></th>
            <td><?= $this->Number->format($configuration->Restaurant_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('CashEnabled') ?></th>
            <td><?= $configuration->CashEnabled ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('MPEnabled') ?></th>
            <td><?= $configuration->MPEnabled ? __('Yes') : __('No'); ?></td>
         </tr>
        <tr>
            <th><?= __('GPEnabled') ?></th>
            <td><?= $configuration->GPEnabled ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
