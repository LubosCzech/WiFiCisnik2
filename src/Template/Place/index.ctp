<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Place'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="place index large-9 medium-8 columns content">
    <h3><?= __('Place') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('ID') ?></th>
            <th><?= $this->Paginator->sort('Name') ?></th>
            <th><?= $this->Paginator->sort('Code') ?></th>
            <th><?= $this->Paginator->sort('Checkout_ID') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($place as $place): ?>
            <tr>
                <td><?= $this->Number->format($place->ID) ?></td>
                <td><?= h($place->Name) ?></td>
                <td><?= h($place->Code) ?></td>
                <td><?= $this->Number->format($place->Checkout_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $place->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $place->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $place->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $place->ID)]) ?>
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

<div class="uk-container uk-container-center">
    <div class="uk-grid" data-uk-grid-margin="">
        <div>
            <ul class="uk-nestable" data-uk-nestable="{group:'test', handleClass:'uk-nestable-handle'}">
                <li class="uk-nestable-item">
                    <div class="uk-nestable-panel">
                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                        <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                        Teplá jídla                        </div>
                </li>
                <li class="uk-nestable-item">
                    <div class="uk-nestable-panel">
                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                        <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                        Nealkoholické nápoje                        </div>
                </li>
                <li class="uk-nestable-item">
                    <div class="uk-nestable-panel">
                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                        <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                        Studená kuchyně                        </div>
                </li>
            </ul>

        </div>
    </div>
</div>