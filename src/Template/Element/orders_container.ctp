<table class="uk-table uk-table-striped uk-text-extralarge uk-height-1-1">
    <thead>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    SetLocale(LC_ALL, "Czech");
    foreach ($orderMain as $orderMain): ?>
        <tr class="uk-margin-small <?php if ($orderMain->OrderState == 2) echo('uk-alert uk-alert-extradanger') ?>"
            onclick="document.getElementsByName('order_link_<?= $orderMain->ID ?>')[0].click();">
            <td><?= h($orderMain->orderSt->Name) ?></td>
            <td><?= h($orderMain->place->Name) ?></td>
            <td><?= $orderMain->Created->format('Y-m-d H:i:s') ?></td>
            <td class="actions">
                <a href="#modal_order"
                   id="order_link"
                   name="order_link_<?= $orderMain->ID ?>"
                   data-uk-modal="{center:true,bgclose:false}"
                   data-id="<?= $orderMain->ID ?>"
                   data-place="<?= $orderMain->place->Name ?>"
                   data-state="<?= $orderMain->OrderState ?>"
                   data-orders='<?= json_encode($orderMain->order_guest) ?>'
                    ><i class="uk-icon-edit uk-icon-medium"
                        data-uk-modal="{center:true,bgclose:false}"
                        data-id="<?= $orderMain->ID ?>"
                        data-place="<?= $orderMain->place->Name ?>"
                        data-state="<?= $orderMain->OrderState ?>"
                        data-orders='<?= json_encode($orderMain->order_guest) ?>'
                        ></i></a>
                <!--?= $this->Html->link(__('View'), ['action' => 'view', $orderMain->ID]) ?-->
                <!--?= $this->Html->link(__('Edit'), ['action' => 'edit', $orderMain->ID]) ?-->
                <!--?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $orderMain->ID], ['confirm' => __('Are you sure you want to delete # {0}?', $orderMain->ID)]) ?-->
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php echo $this->element('pagination', ["modelName" => 'OrderMain', 'options' => ['ajaxPagination' => 'true', 'paginationContainer' => '#orders-container', 'urlParams' => '&userID=' . $loggedUser->ID . '&restaurantID=' . $restaurant->ID]]); ?>