<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_product_edit',bgclose:false,center:true}"]) ?>
    </div>
    <table cellpadding="0" cellspacing="0" class="uk-table uk-table-striped uk-text-extralarge">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($product as $product): ?>
            <tr>
                <td><?= h($product->Name) ?></td>
                <td class="actions">
                    <a href="#modal_product_edit"
                       id="product_link"
                       name="news_link_<?= $product->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $product->ID ?>"
                       data-name="<?= $product->Name?>"
                       data-description="<?= $product->Description?>"
                       data-price="<?= $product->Price?>"
                       data-imageurl="<?= $product->ImageUrl?>"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $product->ID ?>"
                            data-name="<?= $product->Name?>"
                            data-description="<?= $product->Description?>"
                            data-price="<?= $product->Price?>"
                            data-imageurl="<?= $product->ImageUrl?>"
                            ></i></a>
                </td>
                <td class="actions">
                    <a href=""
                       id="product_remove"
                       name="product_remove_link_<?= $product->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $product->ID ?>"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $product->ID ?>"
                            ></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $this->element('pagination', ["modelName" => 'Product', 'options' => ['ajaxPagination' => 'true', 'paginationContainer' => '#product-container', 'urlParams' => '&userID=' . $loggedUser->ID . '&restaurantID=' . $restaurant->ID]]); ?>
</div>