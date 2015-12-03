<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Note'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="note index large-9 medium-8 columns content">
    <h3><?= __('Note') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('OrderGuest_ID') ?></th>
                <th><?= $this->Paginator->sort('Text') ?></th>
                <th><?= $this->Paginator->sort('Guest_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($note as $note): ?>
            <tr>
                <td><?= $this->Number->format($note->ID) ?></td>
                <td><?= $this->Number->format($note->OrderGuest_ID) ?></td>
                <td><?= h($note->Text) ?></td>
                <td><?= $this->Number->format($note->Guest_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $note->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $note->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $note->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $note->ID)]) ?>
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
