<div id="wrap">
    <div id="login_bck" class="uk-height-viewport"></div>
</div>

<div id="modal_login" class="uk-modal"  data-uk-observe>
    <div class="uk-modal-dialog">
        <div class="uk-modal-header">
            <h2>Přihlášení do administrace</h2>
        </div>
        <?php echo $this->Form->create(null, [
            'url' => ['controller' => 'Restaurant', 'action' => 'login'],
            'class'=>'uk-form'
        ]);?>
        <p class="uk-text-center">
        <div class="uk-form uk-text-center">
            <input id="input_login" name="input_login" type="text" placeholder="Login" class="uk-margin-small-top uk-form-width-medium">
            <input id="input_pass" name="input_pass" type="password" placeholder="Heslo" class="uk-margin-small-top uk-form-width-medium">
        </div>
        </p>
        <div class="uk-modal-footer uk-text-center">
            <button type="submit" class="uk-button uk-button-primary uk-button-large" onclick="">Přihlásit</button>
        </div>
        <?php
        echo $this->Form->hidden('login',['value'=>true]);
        echo $this->Form->end(); ?>
    </div>
</div>


<script language="javascript">
    allow_refresh = false;
    refresh_rate = 60;
    var showLogin = <?= $showLogin ?>;
    if (showLogin){
        var modal = UIkit.modal("#modal_login");
        modal.bgclose=false;
        modal.center=true;
        modal.show();
    }

    var badLogin = <?= $badLogin ?>;
    if (badLogin){
        UIkit.notify("<i class='uk-icon-warning'></i> Neplatný login, nebo heslo", {status:'danger'}) ;
    }

</script>