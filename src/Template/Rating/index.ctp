<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="rating index large-9 medium-8 columns content">
    <h3><?= __('Rating') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Guest_Name') ?></th>
                <th><?= $this->Paginator->sort('Comment') ?></th>
                <th><?= $this->Paginator->sort('Question1') ?></th>
                <th><?= $this->Paginator->sort('Question2') ?></th>
                <th><?= $this->Paginator->sort('Question3') ?></th>
                <th><?= $this->Paginator->sort('Question4') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rating as $rating): ?>
            <tr>
                <td><?= $this->Number->format($rating->ID) ?></td>
                <td><?= h($rating->Guest_Name) ?></td>
                <td><?= h($rating->Comment) ?></td>
                <td><?= $this->Number->format($rating->Question1) ?></td>
                <td><?= $this->Number->format($rating->Question2) ?></td>
                <td><?= $this->Number->format($rating->Question3) ?></td>
                <td><?= $this->Number->format($rating->Question4) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $rating->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $rating->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $rating->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->ID)]) ?>
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
