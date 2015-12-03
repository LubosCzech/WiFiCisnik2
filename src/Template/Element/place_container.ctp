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

    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-small" data-uk-grid-margin>

            <div class="uk-grid-1-3 uk-grid-small">
                <div class="uk-panel uk-panel-box uk-panel-box-primary menu-nestable-min">
                    <ul id="menu_tree" class="uk-nestable"
                        data-uk-nestable="{group:'place', handleClass:'uk-nestable-handle',maxDepth:1}">
                        <?php foreach ($place as $place_item): ?>
                            <li class="uk-nestable-item">
                                <div class="uk-nestable-panel">
                                    <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                                    <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                    <?= h($place_item->Name) ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="uk-panel-badge uk-badge">Místa</div>
                </div>
            </div>

            <?php foreach ($checkout as $checkout_item): ?>
                <div class="uk-grid-1-3">
                    <div class="uk-panel uk-panel-box menu-nestable-min">
                        <ul id="product_menu" class="uk-nestable"
                            data-uk-nestable="{group:'place', handleClass:'uk-nestable-handle',maxDepth:1}">

                        </ul>
                        <div class="uk-panel-badge uk-badge"><?= h($checkout_item->Name) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
    <div class="uk-panel uk-margin-large-top">
        <?= $this->Form->button('Uložit', ['class' => 'uk-button uk-button-primary uk-button-large']) ?>
    </div>
</div>
<script>
    jQuery(function ($) {
        $('.uk-nestable').on({
            'start.uk.nestable': function () {
                console.log('start', arguments);
            },
            'move.uk.nestable': function () {
                console.log('move', arguments);
            },
            'change.uk.nestable': function () {
                console.log('change', arguments);

            }
        });
    });
</script>
