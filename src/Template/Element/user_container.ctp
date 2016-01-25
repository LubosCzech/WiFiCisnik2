<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_user_edit',bgclose:false,center:true}"]) ?>
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
        <?php foreach ($allUsers as $user): ?>
            <tr>
                <td><?= h($user->FullName) ?></td>
                <td>
                <?php foreach ($checkout as $checkout_item) {
                        if ($user->Checkout_ID == $checkout_item->ID) {
                            echo h($checkout_item->Name);
                        }
                    }?>
                </td>
                <td class="actions">
                    <a href="#modal_user_edit"
                       id="user_link"
                       name="user_link_<?= $user->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $user->ID ?>"
                       data-fullname="<?= $user->FullName?>"
                       data-login="<?= $user->Login?>"
                       data-pwd="<?= $user->Password?>"
                       data-role="<?= $user->Role?>"
                       data-checkout="<?= $user->Checkout_ID?>"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $user->ID ?>"
                            data-fullname="<?= $user->FullName?>"
                            data-login="<?= $user->Login?>"
                            data-pwd="<?= $user->Password?>"
                            data-role="<?= $user->Role?>"
                            data-checkout="<?= $user->Checkout_ID?>"
                            ></i></a>
                </td>
                <td class="actions">
                    <a href=""
                       id="user_remove"
                       name="user_remove_link_<?= $user->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $user->ID ?>"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $user->ID ?>"
                            ></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>