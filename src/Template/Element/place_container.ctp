<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_place_edit',bgclose:false,center:true}"]) ?>
    </div>
    <table cellpadding="0" cellspacing="0" class="uk-table uk-table-striped uk-text-extralarge">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($place as $place_item) {
            echo('<tr>');
            echo('<td>' . h($place_item->Name) . '</td>');
            echo('<td>' . h($place_item->Code) . '</td>');
            echo('<td>');
            foreach ($checkout as $checkout_item) {
                if ($place_item->Checkout_ID == $checkout_item->ID) {
                    echo($checkout_item->Name);
                }
            }
            echo('</td>');
            echo('<td class="actions">');
            echo('<a href="#modal_place_edit"
                       id="place_link"
                       name="place_link_'.$place_item->ID.'"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="'.$place_item->ID.'"
                       data-name="'.$place_item->Name.'"
                       data-code="'.$place_item->Code.'"
                       data-checkout="'.$place_item->Checkout.'"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="'.$place_item->ID.'"
                            data-name="'.$place_item->Name.'"
                            data-code="'.$place_item->Code.'"
                            data-checkout="'.$place_item->Checkout_ID.'"
                            ></i></a>');
            echo('<td>');
            echo('<td class="actions">');
            echo('<a href=""
                       id="place_remove"
                       name="place_remove_link_'.$place_item->ID.'"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="'.$place_item->ID.'"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="'.$place_item->ID.'"
                            ></i></a>');
            echo('<td>');
            echo('</tr>');

        } ?>
        </tbody>
    </table>
</div>
