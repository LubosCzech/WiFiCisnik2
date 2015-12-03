<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $user->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('FullName') ?></th>
            <td><?= h($user->FullName) ?></td>
        </tr>
        <tr>
            <th><?= __('Login') ?></th>
            <td><?= h($user->Login) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->Password) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($user->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Role') ?></th>
            <td><?= $this->Number->format($user->Role) ?></td>
        </tr>
        <tr>
            <th><?= __('Checkout ID') ?></th>
            <td><?= $this->Number->format($user->Checkout_ID) ?></td>
        </tr>
    </table>
</div>
