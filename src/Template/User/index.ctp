<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Checkout'), ['controller' => 'Checkout', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Checkout'), ['controller' => 'Checkout', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="user index large-9 medium-8 columns content">
    <h3><?= __('User') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('ID') ?></th>
                <th><?= $this->Paginator->sort('FullName') ?></th>
                <th><?= $this->Paginator->sort('Login') ?></th>
                <th><?= $this->Paginator->sort('Password') ?></th>
                <th><?= $this->Paginator->sort('Role') ?></th>
                <th><?= $this->Paginator->sort('Checkout_ID') ?></th>
                <th><?= $this->Paginator->sort('Restaurant_ID') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($user as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->ID) ?></td>
                <td><?= h($user->FullName) ?></td>
                <td><?= h($user->Login) ?></td>
                <td><?= h($user->Password) ?></td>
                <td><?= $this->Number->format($user->Role) ?></td>
                <td><?= $this->Number->format($user->Checkout_ID) ?></td>
                <td><?= $this->Number->format($user->Restaurant_ID) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->ID]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->ID]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]) ?>
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
