<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New News'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="news index large-9 medium-8 columns content">
    <h3><?= __('News') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('Title') ?></th>
                <th><?= $this->Paginator->sort('Text') ?></th>
                <th><?= $this->Paginator->sort('Created') ?></th>
                <th><?= $this->Paginator->sort('Restaurant_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($news as $news): ?>
            <tr>
                <td><?= $this->Number->format($news->ID) ?></td>
                <td><?= h($news->Title) ?></td>
                <td><?= h($news->Text) ?></td>
                <td><?= h($news->Created) ?></td>
                <td><?= $this->Number->format($news->Restaurant_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $news->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $news->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $news->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $news->ID)]) ?>
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
