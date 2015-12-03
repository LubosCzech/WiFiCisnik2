<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Rating'), ['action' => 'edit', $rating->ID]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Rating'), ['action' => 'delete', $rating->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $rating->ID)]) ?> </li>
        <li><?= $this->Html->link(__('List Rating'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Rating'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="rating view large-9 medium-8 columns content">
    <h3><?= h($rating->ID) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Guest Name') ?></th>
            <td><?= h($rating->Guest_Name) ?></td>
        </tr>
        <tr>
            <th><?= __('Comment') ?></th>
            <td><?= h($rating->Comment) ?></td>
        </tr>
        <tr>
            <th><?= __('ID') ?></th>
            <td><?= $this->Number->format($rating->ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Question1') ?></th>
            <td><?= $this->Number->format($rating->Question1) ?></td>
        </tr>
        <tr>
            <th><?= __('Question2') ?></th>
            <td><?= $this->Number->format($rating->Question2) ?></td>
        </tr>
        <tr>
            <th><?= __('Question3') ?></th>
            <td><?= $this->Number->format($rating->Question3) ?></td>
        </tr>
        <tr>
            <th><?= __('Question4') ?></th>
            <td><?= $this->Number->format($rating->Question4) ?></td>
        </tr>
        <tr>
            <th><?= __('Question5') ?></th>
            <td><?= $this->Number->format($rating->Question5) ?></td>
        </tr>
        <tr>
            <th><?= __('Guest ID') ?></th>
            <td><?= $this->Number->format($rating->Guest_ID) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant ID') ?></th>
            <td><?= $this->Number->format($rating->Restaurant_ID) ?></td>
        </tr>
    </table>
</div>
