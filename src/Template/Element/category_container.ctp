<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_category_edit',bgclose:false,center:true}"]) ?>
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
        <?php foreach ($category as $category): ?>
            <tr>
                <td><?= h($category->Name) ?></td>
                <td class="actions">
                    <a href="#modal_category_edit"
                       id="category_link"
                       name="category_link_<?= $category->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $category->ID ?>"
                       data-name="<?= $category->Name?>"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $category->ID ?>"
                            data-name="<?= $category->Name?>"
                            ></i></a>
                </td>
                <td class="actions">
                    <a href=""
                       id="category_remove"
                       name="category_remove_link_<?= $category->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $category->ID ?>"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $category->ID ?>"
                            ></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php echo $this->element('pagination', ["modelName" => 'Category', 'options' => ['ajaxPagination' => 'true', 'paginationContainer' => '#category-container', 'urlParams' => '&userID=' . $loggedUser->ID . '&restaurantID=' . $restaurant->ID]]); ?>
</div>