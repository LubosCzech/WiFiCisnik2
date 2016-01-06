<?php $this->start('placeid_modal'); ?>
    <div id="modal_placeid" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2><?= $localization['modal_enter'] ?> <?= h($restaurant->configuration->PlaceText) ?></h2>
            </div>
            <p class="uk-text-center">

            <form class="uk-form uk-text-center">
                <input id="input_placeid" type="text"
                       placeholder="<?= ucfirst(h($restaurant->configuration->PlaceText)) ?>"
                       class="uk-margin-small-top uk-form-width-medium">
            </form>
            </p>
            <div class="uk-modal-footer uk-text-center">
                <button type="button" class="uk-button uk-button-primary uk-button-large" onclick="notifyWithID()">
                    <?= $localization['btn_confirm'] ?>
                </button>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('placeid_noclose_modal'); ?>
    <div id="modal_placeid" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog">
            <div class="uk-modal-header">
                <h2><?= $localization['modal_enter'] ?> <?= h($restaurant->configuration->PlaceText) ?></h2>
            </div>
            <p class="uk-text-center">

            <form class="uk-form uk-text-center">
                <input id="input_placeid" type="text" placeholder="<?= ucfirst(h($restaurant->configuration->PlaceText)) ?>"
                       class="uk-margin-small-top uk-form-width-medium">
            </form>
            </p>
            <div class="uk-modal-footer uk-text-center">
                <button type="button" class="uk-button uk-button-primary uk-button-large" onclick="checkAndSavePlaceID()">
                    <?= $localization['btn_confirm'] ?>
                </button>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('note_modal'); ?>
    <div id="modal_note" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2><?= $localization['main_opinion'] ?></h2>
            </div>
            <div class="uk-container-center">
                <div class="uk-panel uk-panel-box">
                    <form class="uk-form uk-form-horizontal" id="form_rating">
                        <fieldset>
                            <div class="uk-form-row">
                                <label class="uk-form-label" for="input_name"><?= $localization['txt_name'] ?></label>

                                <div class="uk-form-controls">
                                    <input id="input_name" name="name" type="text"
                                           placeholder="<?= $localization['txt_name_holder'] ?>"
                                           class="uk-margin-small-top uk-form-width-medium">
                                </div>
                            </div>
                            <?php
                            if (isset($restaurant->configuration->Question1) && !is_null($restaurant->configuration->Question1)) {
                                echo('<div class="uk-form-row">');
                                echo('<label class="uk-form-label" for="input_name">' . $restaurant->configuration->Question1 . '</label>');
                                echo('<div class="uk-form-controls">');
                                echo('<div id="star_question1"></div>');
                                echo $this->Form->input('question1', ['type' => 'hidden']);
                                echo('</div>');
                                echo('</div>');
                            }
                            if (isset($restaurant->configuration->Question2) && !is_null($restaurant->configuration->Question2)) {
                                echo('<div class="uk-form-row">');
                                echo('<label class="uk-form-label" for="input_name">' . $restaurant->configuration->Question2 . '</label>');
                                echo('<div class="uk-form-controls">');
                                echo('<div id="star_question2"></div>');
                                echo $this->Form->input('question2', ['type' => 'hidden']);
                                echo('</div>');
                                echo('</div>');
                            }
                            if (isset($restaurant->configuration->Question3) && !is_null($restaurant->configuration->Question3)) {
                                echo('<div class="uk-form-row">');
                                echo('<label class="uk-form-label" for="input_name">' . $restaurant->configuration->Question3 . '</label>');
                                echo('<div class="uk-form-controls">');
                                echo('<div id="star_question3"></div>');
                                echo $this->Form->input('question3', ['type' => 'hidden']);
                                echo('</div>');
                                echo('</div>');
                            }
                            if (isset($restaurant->configuration->Question4) && !is_null($restaurant->configuration->Question4)) {
                                echo('<div class="uk-form-row">');
                                echo('<label class="uk-form-label" for="input_name">' . $restaurant->configuration->Question4 . '</label>');
                                echo('<div class="uk-form-controls">');
                                echo('<div id="star_question4"></div>');
                                echo $this->Form->input('question4', ['type' => 'hidden']);
                                echo('</div>');
                                echo('</div>');
                            }
                            if (isset($restaurant->configuration->Question5) && !is_null($restaurant->configuration->Question5)) {
                                echo('<div class="uk-form-row">');
                                echo('<label class="uk-form-label" for="input_name">' . $restaurant->configuration->Question5 . '</label>');
                                echo('<div class="uk-form-controls">');
                                echo('<div id="star_question5"></div>');
                                echo $this->Form->input('question5', ['type' => 'hidden']);
                                echo('</div>');
                                echo('</div>');
                            }
                            ?>
                            <div class="uk-form-row">
                                <label class="uk-form-label"
                                       for="area_comment"><?= $localization['txt_comment'] ?></label>

                                <div class="uk-form-controls">
                                    <textarea id="area_comment" name="comment" cols="30" rows="5"
                                              placeholder="<?= $localization['txt_comment_holder'] ?>"></textarea>
                                </div>
                            </div>

                            <input id="restaurant_id" name="restaurant_id" value="<?= $restaurant->ID ?>" type="hidden">
                        </fieldset>
                    </form>
                </div>
            </div>
            <div class="uk-modal-footer uk-text-center">
                <button type="button" class="uk-button uk-button-primary uk-button-large" onclick="sendRate()">
                    <?= $localization['btn_rate'] ?>
                </button>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('news_modal'); ?>
    <div id="modal_news" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2><?= $localization['main_news'] ?></h2>
            </div>
            <div class="uk-container-center uk-overflow-container">
                <?php foreach ($restaurant->news as $news): ?>
                    <div class="uk-panel uk-panel-box uk-panel-box-primary uk-margin-small-top">
                        <div class="uk-panel-badge uk-badge"><?= h($news->Created->format('d.m.Y')) ?></div>
                        <h3 class="uk-panel-title"><?= h($news->Title) ?></h3>
                        <?= $news->Text ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="uk-modal-footer uk-text-center">
                <button type="button" class="uk-button uk-button-danger uk-modal-close uk-button-large" onclick="">
                    <?= $localization['btn_close'] ?>
                </button>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('guest_config_modal'); ?>
    <div id="modal_guest_config" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2><?= $localization['main_configuration'] ?></h2>
            </div>
            <div class="uk-container-center">
                <form class="uk-form uk-form-horizontal" id="form_guest_config">
                    <fieldset>
                        <div class="uk-form-row">
                            <label class="uk-form-label" for="language"><?= $localization['txt_language'] ?></label>
                            <div class="uk-form-controls">
                                <select name="language" class="uk-margin-small-top uk-width-100" id="language">
                                    <option value="Cz">Čeština</option>
                                    <option value="En">English</option>
                                </select>
                            </div>
                            </div>
                            <div class="uk-form-row">
                                <label class="uk-form-label" for="placeID"><?= ucfirst(h($restaurant->configuration->PlaceText)) ?>: <?= $cookieHelper->read('WiFiCisnik.PlaceName');?></label>
                                <div class="uk-form-controls">
                                    <button type="button" class="uk-button uk-button-primary uk-button-large uk-width-100" onclick="removeGuestPlace()">
                                        <?= $localization['btn_leave'] ?>
                                    </button>
                                </div>
                             </div>
                    </fieldset>
            </div>
            <div class="uk-modal-footer uk-text-center">
                <button type="button" class="uk-button uk-button-primary uk-button-large" onclick="saveGuestConfig()">
                    <?= $localization['btn_save'] ?>
                </button>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('news_edit_modal'); ?>
    <div id="modal_news_edit" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Editace novinek</h2>
            </div>
            <div class="uk-container-center">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'savenewsajax'],
                    'class' => 'uk-form uk-form-horizontal',
                    'id' => 'form_news_edit'
                ]); ?>
                <fieldset>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="title_text">Titulek</label>

                        <div class="uk-form-controls">
                            <input type="text" name="title_text" id="title_text" placeholder="Titulek novinky"
                                   class="uk-form-width-large">
                        </div>
                    </div>

                    <div class="uk-form-row">
                        <label class="uk-form-label" for="news_text">Obsah</label>

                        <div class="uk-form-controls">
                        <textarea id="news_text" name="news_text" cols="40" rows="6"
                                  placeholder="Text novinky" class="uk-form-width-large"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="uk-modal-footer uk-margin-small-top">
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" class="uk-button uk-button-primary uk-button-large"
                                            onclick="">
                                        Uložit
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
            </div>
            <?= $this->Form->hidden('news_id', ['id' => 'news_id']); ?>
            <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id', 'value' => $restaurant->ID]); ?>
            </form>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('order_modal'); ?>
    <div id="modal_order" class="uk-modal uk-clearfix" data-uk-observe>
        <div class="uk-modal-dialog">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Objednavka - nahled</h2>
            </div>
            <div class="uk-overflow-container" id="orders_container">
                <div class="uk-panel">
                    <div class="uk-panel-badge uk-badge">Hotově</div>
                    <h3 class="uk-panel-title">Zákazník:0 Celkem:000Kč</h3>
                    <table class="uk-table uk-text-large">
                        <thead>
                        <tr>
                            <th>Název</th>
                            <th>Počet</th>
                            <th>Cena</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Svíčková</td>
                            <td>1</td>
                            <td>250</td>
                        </tr>
                        <tr>
                            <td>Sekaná</td>
                            <td>1</td>
                            <td>75</td>
                        </tr>
                        <tr>
                            <td>Nakládaný hermelín</td>
                            <td>1</td>
                            <td>80</td>
                        </tr>
                        <tr>
                            <td>Pepsi 250ml</td>
                            <td>1</td>
                            <td>40</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="uk-modal-footer">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'admin', $restaurant->Code],
                    'class' => 'uk-form'
                ]); ?>
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" name="process_order"
                                            class="uk-button uk-button-primary uk-button-large" onclick="">Přijmout
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
                <?php
                echo $this->Form->hidden('order_id');
                echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('product_edit_modal'); ?>
    <div id="modal_product_edit" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Editace produktu</h2>
            </div>
            <div class="uk-container-center">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'saveproductajax'],
                    'class' => 'uk-form uk-form-horizontal',
                    'id' => 'form_product_edit'
                ]); ?>
                <fieldset>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="name_text">Název</label>

                        <div class="uk-form-controls">
                            <input type="text" name="name_text" id="name_text" placeholder="Název produktu"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="price_text"><?= $localization['txt_price'] ?></label>

                        <div class="uk-form-controls">
                            <input type="text" name="price_text" id="price_text" placeholder="Cena produktu (bez měny)"
                                   class="uk-form-width-medium">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="image_text">Obrázek</label>

                        <div class="uk-form-controls">
                            <input type="text" name="image_text" id="image_text" placeholder="Cesta k obrázku"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="description_text">Popis</label>

                        <div class="uk-form-controls">
                        <textarea id="description_text" name="description_text" cols="40" rows="6"
                                  placeholder="Popis produktu" class="uk-form-width-large"></textarea>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="uk-modal-footer uk-margin-small-top">
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" class="uk-button uk-button-primary uk-button-large"
                                            onclick="">
                                        Uložit
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
            </div>
            <?= $this->Form->hidden('product_id', ['id' => 'product_id']); ?>
            <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id', 'value' => $restaurant->ID]); ?>
            </form>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('category_edit_modal'); ?>
    <div id="modal_category_edit" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Editace kategorie</h2>
            </div>
            <div class="uk-container-center">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'savecategoryajax'],
                    'class' => 'uk-form uk-form-horizontal',
                    'id' => 'form_category_edit'
                ]); ?>
                <fieldset>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="category_text">Název</label>

                        <div class="uk-form-controls">
                            <input type="text" name="category_text" id="category_text" placeholder="Název kategorie"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="uk-modal-footer uk-margin-small-top">
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" class="uk-button uk-button-primary uk-button-large"
                                            onclick="">
                                        Uložit
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
            </div>
            <?= $this->Form->hidden('category_id', ['id' => 'category_id']); ?>
            <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id', 'value' => $restaurant->ID]); ?>
            </form>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('checkout_edit_modal'); ?>
    <div id="modal_checkout_edit" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Editace pokladny</h2>
            </div>
            <div class="uk-container-center">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'savecheckoutajax'],
                    'class' => 'uk-form uk-form-horizontal',
                    'id' => 'form_checkout_edit'
                ]); ?>
                <fieldset>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="checkout_text">Název</label>

                        <div class="uk-form-controls">
                            <input type="text" name="checkout_text" id="checkout_text" placeholder="Název pokladny"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="uk-modal-footer uk-margin-small-top">
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" class="uk-button uk-button-primary uk-button-large"
                                            onclick="">
                                        Uložit
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
            </div>
            <?= $this->Form->hidden('checkout_id', ['id' => 'checkout_id']); ?>
            <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id', 'value' => $restaurant->ID]); ?>
            </form>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('place_edit_modal'); ?>
    <div id="modal_place_edit" class="uk-modal" data-uk-observe>
        <div class="uk-modal-dialog uk-modal-dialog-large">
            <button type="button" class="uk-modal-close uk-close"></button>
            <div class="uk-modal-header">
                <h2>Editace místa</h2>
            </div>
            <div class="uk-container-center">
                <?php echo $this->Form->create(null, [
                    'url' => ['controller' => 'Restaurant', 'action' => 'saveplaceajax'],
                    'class' => 'uk-form uk-form-horizontal',
                    'id' => 'form_place_edit'
                ]); ?>
                <fieldset>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="place_text">Název</label>

                        <div class="uk-form-controls">
                            <input type="text" name="place_text" id="place_text" placeholder="Název místa"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="place_code">Kód</label>

                        <div class="uk-form-controls">
                            <input type="text" name="place_code" id="place_code" placeholder="Kód místa"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                    <div class="uk-form-row">
                        <label class="uk-form-label" for="place_checkout">Pokladna</label>

                        <div class="uk-form-controls">
                            <input type="text" name="place_checkout" id="place_checkout" placeholder="ID pokladny"
                                   class="uk-form-width-large">
                        </div>
                    </div>
                </fieldset>
            </div>

            <div class="uk-modal-footer uk-margin-small-top">
                <div class="uk-form-row">
                    <nav>
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="button"
                                        class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                    Zavřít
                                </button>
                            </li>
                        </ul>

                        <div class="uk-navbar-flip">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <button type="submit" class="uk-button uk-button-primary uk-button-large"
                                            onclick="">
                                        Uložit
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="uk-navbar-content uk-navbar-center"></div>
                    </nav>
                </div>
            </div>
            <?= $this->Form->hidden('place_id', ['id' => 'place_id']); ?>
            <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id', 'value' => $restaurant->ID]); ?>
            </form>
        </div>
    </div>
<?php $this->end(); ?>

<?php $this->start('product_modal'); ?>
<div id="modal_product" class="uk-modal" data-uk-observe>
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header uk-margin-small-bottom">
            <h2>Název produktu</h2>
        </div>
        <figure class="uk-overlay uk-margin-small-top uk-margin-small-bottom">
            <?= $this->Html->image('placeholder.png', ['alt' => 'Obrázek produktu', 'width' => '600', 'height' => '400', 'name' => 'productImg', 'id'=>'menu-product-image']); ?>
            <figcaption class="uk-overlay-panel uk-overlay-background uk-overlay-bottom">
                <h3>Cena: XXX Kč</h3>

                <p class="uk-text-small">Popis produktu</p>
            </figcaption>
        </figure>
        <div class="uk-modal-footer uk-margin-small-top">
            <?php echo $this->Form->create(null, [
                'url' => ['controller' => 'Menu', 'action' => 'Index'],
                'class' => 'uk-form',
                'id' => 'modal-product-form'
            ]); ?>
            <div class="uk-form-row">
                <nav>
                    <ul class="uk-navbar-nav">
                        <li>
                            <button type="button" class="uk-button uk-button-large" onclick="decrementCount()">-
                            </button>
                        </li>
                        <li><input type="text" id="product_count" name="product_count" placeholder="."
                                   class="uk-form-width-mini uk-form-large" value="1"></li>
                        <li>
                            <button type="button" class="uk-button uk-button-large" onclick="incrementCount()">+
                            </button>
                        </li>
                    </ul>

                    <div class="uk-navbar-flip">
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="submit" class="uk-button uk-button-primary uk-button-large"><?= $localization['btn_add'] ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-content uk-navbar-center"></div>
                </nav>
            </div>
            <?php
            echo $this->Form->hidden('product_id');
            echo $this->Form->hidden('category_id');
            echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('cart_modal'); ?>
<div id="modal_cart" class="uk-modal" data-uk-observe>
    <div class="uk-modal-dialog">
        <button type="button" class="uk-modal-close uk-close"></button>
        <div class="uk-modal-header">
            <h2><?= $localization['txt_cart'] ?></h2>
        </div>
        <div class="uk-overflow-container" id="cart-container">
            <?php echo $this->element('cart_container'); ?>
        </div>
        <?php echo $this->Form->create(null, [
            'url' => ['controller' => 'Menu', 'action' => 'Index'],
            'class' => 'uk-form'
        ]); ?>
        <fieldset>
            <legend><?= $localization['txt_note'] ?></legend>
            <div class="uk-form-row uk-text-center">
                <input name="note" type="text" class="uk-margin-small-bottom uk-width-100"
                       placeholder="<?= $restaurant->configuration->NoteTextHolder ?>">
            </div>
        </fieldset>
        <fieldset>
            <legend>
                <?= $localization['txt_paymethod'] ?>
            </legend>
            <div class="uk-form-row uk-text-center">
                <div class="uk-form-controls">
                    <select name="payMethod" class="uk-margin-small-top uk-width-100" id="payMethod">
                        <?php
                        if ($restaurant->configuration->CashEnabled)
                            echo('<option value="1">Hotově</option>');

                        if ($restaurant->configuration->MPEnabled)
                            echo(' <option value="3"  selected="selected">MasterPass</option>');

                        if ($restaurant->configuration->GPEnabled)
                            echo('<option value="2">Kartou online</option>');
                        ?>
                    </select>
                </div>
            </div>
        </fieldset>
        <div class="uk-modal-footer uk-margin-small-top">

            <div class="uk-form-row">
                <nav>
                    <ul class="uk-navbar-nav">
                        <li>
                            <button type="button" class="uk-button uk-button-danger uk-button-large uk-modal-close">
                                <?= $localization['btn_close'] ?>
                            </button>
                        </li>
                    </ul>

                    <div class="uk-navbar-flip">
                        <ul class="uk-navbar-nav">
                            <li>
                                <button type="submit" class="uk-button uk-button-primary uk-button-large" onclick="">
                                    <?= $localization['btn_send'] ?>
                                </button>
                            </li>
                        </ul>
                    </div>
                    <div class="uk-navbar-content uk-navbar-center">
                        <?= $this->Html->image('masterpass_logo.png', ['alt' => 'Vybraná metoda platby', 'width' => '100', 'height' => '20', 'name' => 'payMethodImg', 'id'=>'payMethodImg','class'=>'uk-hidden']); ?>
                    </div>
                </nav>
            </div>
        </div>
        <?php

        echo $this->Form->hidden('sendOrder', ['value' => true]);
        echo $this->Form->end(); ?>
    </div>
</div>
<?php $this->end(); ?>