<div class="uk-panel uk-panel-box">
    <div class="uk-panel-badge uk-badge">Rozšířené nastavení</div>
        <?= $this->Form->create($restaurant->configuration,['class'=>'uk-form uk-form-horizontal', 'id'=>'form_restaurant_config','url' => ['controller' => 'Restaurant', 'action' => 'saverestaurantconfigajax']]) ?>
        <fieldset>
            <div class="uk-form-row">
                <label for="CurrencySign" class="uk-form-label">Znak měny:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('CurrencySign', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="WelcomeText" class="uk-form-label">Uvítací text:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('WelcomeText', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="AdminText" class="uk-form-label">Uvítací text(admin):</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('AdminText', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="PlaceText" class="uk-form-label">Pojmenování místa:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('PlaceText', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="NoteTextHolder" class="uk-form-label">Placeholder pro poznámku:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('NoteTextHolder', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="Archive" class="uk-form-label">Archivovat objednávky po(hodiny):</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('Archive', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="CashEnabled" class="uk-form-label">Platba v hotovosti:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('CashEnabled', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="MPEnabled" class="uk-form-label">Platba MasterPass:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('MPEnabled', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="GPEnabled" class="uk-form-label">Platba GPWebPay:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('GPEnabled', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
            <div class="uk-form-row">
                <label for="ShowMainBadges" class="uk-form-label">Zobrazit popisky:</label>

                <div class="uk-form-controls">
                    <?= $this->Form->input('ShowMainBadges', ['label' => false, 'class' => 'uk-form-large uk-width-100']) ?>
                </div>
            </div>
        </fieldset>
        <div class="uk-form-row uk-margin-top">
            <div class="uk-form-controls">
                <?= $this->Form->button('Uložit', ['class' => 'uk-button uk-button-primary uk-button-large']) ?>
            </div>
        </div>
        <?= $this->Form->hidden('restaurant_id', ['id' => 'restaurant_id','value'=>$restaurant->ID]);?>
        <?= $this->Form->hidden('configuration_id', ['id' => 'configuration_id','value'=>$restaurant->configuration->ID]);?>
        <?= $this->Form->end() ?>
</div>