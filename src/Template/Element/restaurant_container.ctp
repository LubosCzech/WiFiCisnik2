<div class="uk-panel uk-panel-box">
    <div class="uk-panel-badge uk-badge">Základní údaje</div>
        <?= $this->Form->create(null,['class'=>'uk-form uk-form-horziontal', 'id'=>'form_restaurant_main','url' => ['controller' => 'Restaurant', 'action' => 'saverestaurantajax']]) ?>
        <fieldset>
            <div class="uk-form-row">
                <label for="name" class="uk-form-label">Název:</label>
                <div class="uk-form-controls">
                    <?= $this->Form->input('restaurant_name', ['label' => false, 'class' => 'uk-form-large uk-width-100', 'id'=>'restaurant_name','value'=>$restaurant->Name]) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="name" class="uk-form-label">Cesta k logu:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('restaurant_logoUrl', ['label' => false, 'class' => 'uk-form-large uk-width-100', 'id'=>'restaurant_logoUrl','value'=>$restaurant->LogoUrl]) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="name" class="uk-form-label">Web:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('restaurant_webUrl', ['label' => false, 'class' => 'uk-form-large uk-width-100', 'id'=>'restaurant_webUrl','value'=>$restaurant->WebUrl]) ?>
                </div>
            </div>
        </fieldset>
        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <?= $this->Form->button('Uložit', ['class' => 'uk-button uk-button-primary uk-button-large','type'=>'submit']) ?>
            </div>
        </div>
        <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id','value'=>$restaurant->ID]);?>
        <?= $this->Form->end() ?>
</div>



