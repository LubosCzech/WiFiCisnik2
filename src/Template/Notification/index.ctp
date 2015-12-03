<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Notification'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="notification index large-9 medium-8 columns content">
    <h3><?= __('Notification') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Guest_ID') ?></th>
                <th><?= $this->Paginator->sort('Place_ID') ?></th>
                <th><?= $this->Paginator->sort('State') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notification as $notification): ?>
            <tr>
                <td><?= $this->Number->format($notification->ID) ?></td>
                <td><?= $this->Number->format($notification->Guest_ID) ?></td>
                <td><?= $this->Number->format($notification->Place_ID) ?></td>
                <td><?= $this->Number->format($notification->State) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $notification->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notification->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $notification->ID)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
