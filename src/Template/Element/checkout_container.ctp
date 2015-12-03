<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_checkout_edit',bgclose:false,center:true}"]) ?>
    </div>
    <table cellpadding="0" cellspacing="0" class="uk-table uk-table-striped uk-text-extralarge">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($checkout as $checkout): ?>
            <tr>
                <td><?= h($checkout->Name) ?></td>
                <td><?= h($checkout->Code) ?></td>
                <td class="actions">
                    <a href="#modal_checkout_edit"
                       id="checkout_link"
                       name="checkout_link_<?= $checkout->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $checkout->ID ?>"
                       data-name="<?= $checkout->Name?>"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $checkout->ID ?>"
                            data-name="<?= $checkout->Name?>"
                            ></i></a>
                </td>
                <td class="actions">
                    <a href=""
                       id="checkout_remove"
                       name="checkout_remove_link_<?= $checkout->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $checkout->ID ?>"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $checkout->ID ?>"
                            ></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>