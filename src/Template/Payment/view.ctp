<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Payment'), ['action' => 'edit', $payment->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Payment'), ['action' => 'delete', $payment->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $payment->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Payment'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Payment'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="payment view large-9 medium-8 columns content">
    <h3><?= h($payment->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($payment->Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Code') ?></th>
            <td><?= h($payment->Code) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($payment->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Type') ?></th>
            <td><?= $this->Number->format($payment->Type) ?></td>
        </tr>
        <tr>
            <th><?= __('Gratuity') ?></th>
            <td><?= $payment->Gratuity ? __('Yes') : __('No'); ?></td>
         </tr>
    </table>
</div>
