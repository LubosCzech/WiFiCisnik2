<div class="uk-panel uk-panel-box">
    <div class="uk-container uk-container-center">
        <div class="uk-grid uk-grid-small" data-uk-grid-margin>
            <div class="uk-grid-1-3 uk-grid-small">
                <div class="uk-panel uk-panel-box uk-panel-box-primary menu-nestable-min">
                    <ul id="menu_tree" class="uk-nestable"
                        data-uk-nestable="{group:'menu', handleClass:'uk-nestable-handle',maxDepth:2}">
                        <?php foreach ($menu as $category_item): ?>
                            <li class="uk-nestable-item">
                                <div class="uk-nestable-panel">
                                    <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                                    <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                    <?= h($category_item->Name) ?>
                                </div>
                                <ul class="uk-nestable-list">
                                    <?php foreach ($category_item->Products as $product_item): ?>
                                        <li class="uk-nestable-item">
                                            <div class="uk-nestable-panel">
                                                <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                                                <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                                <?= h($product_item->Name) ?>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="uk-panel-badge uk-badge">Menu</div>
                </div>
            </div>

            <div class="uk-grid-1-3">
                <div class="uk-panel uk-panel-box menu-nestable-min">
                    <ul id="category_menu" class="uk-nestable"
                        data-uk-nestable="{group:'menu', handleClass:'uk-nestable-handle',maxDepth:1}">
                        <?php foreach ($category as $category_item):
                            $inMenu = false;
                            foreach ($menu as $cat) {
                                if ($cat->ID == $category_item->ID)
                                    $inMenu = true;
                            }
                            if (!$inMenu):
                                ?>
                                <li class="uk-nestable-item">
                                    <div class="uk-nestable-panel">
                                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                                        <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                        <?= h($category_item->Name) ?>
                                    </div>
                                </li>
                            <?php
                            endif;
                        endforeach; ?>
                    </ul>
                    <div class="uk-panel-badge uk-badge">Kategorie</div>
                </div>
            </div>

            <div class="uk-grid-1-3">
                <div class="uk-panel uk-panel-box menu-nestable-min">
                    <ul id="product_menu" class="uk-nestable"
                        data-uk-nestable="{group:'menu', handleClass:'uk-nestable-handle',maxDepth:1}">
                        <?php foreach ($product as $product_item):
                            $inMenu = false;
                            foreach ($menu as $cat) {
                                foreach ($cat->Products as $pr) {
                                    if ($pr->ID == $product_item->ID)
                                        $inMenu = true;
                                }
                            }
                            if (!$inMenu):
                                ?>
                                <li class="uk-nestable-item">
                                    <div class="uk-nestable-panel">
                                        <i class="uk-nestable-handle uk-icon uk-icon-bars uk-margin-small-right"></i>

                                        <div class="uk-nestable-toggle" data-nestable-action="toggle"></div>
                                        <?= h($product_item->Name) ?>
                                    </div>
                                </li>
                            <?php
                            endif;
                        endforeach; ?>
                    </ul>
                    <div class="uk-panel-badge uk-badge">Produkty</div>
                </div>
            </div>

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
