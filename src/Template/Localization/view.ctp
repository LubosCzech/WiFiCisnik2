<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Localization'), ['action' => 'edit', $localization->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Localization'), ['action' => 'delete', $localization->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $localization->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Localization'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Localization'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="localization view large-9 medium-8 columns content">
    <h3><?= h($localization->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($localization->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('Czech') ?></th>
            <td><?= h($localization->Czech) ?></td>
        </tr>
        <tr>
            <th><?= __('English') ?></th>
            <td><?= h($localization->English) ?></td>
        </tr>
        <tr>
            <th><?= __('German') ?></th>
            <td><?= h($localization->German) ?></td>
        </tr>
        <tr>
            <th><?= __('Slovak') ?></th>
            <td><?= h($localization->Slovak) ?></td>
        </tr>
        <tr>
            <th><?= __('Polish') ?></th>
            <td><?= h($localization->Polish) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($localization->ID) ?></td>
        </tr>
    </table>
</div>
