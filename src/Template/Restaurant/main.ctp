<div id="wrap">
    <div id="bck_main" class="uk-animation-slide-bottom">
        <ul class="uk-grid uk-grid-small uk-grid-width-1-2 uk-grid-width-small-1-3 uk-grid-width-medium-1-4 uk-grid-width-large-1-5 uk-grid-width-xlarge-1-6"
            data-uk-grid-margin="" id="main">
            <li class="uk-grid-margin">
                <div>
                    <?php
                        if($restaurant->configuration->ShowMainBadges){
                            $orderLinkText = '<i class="uk-icon-cutlery uk-icon-extralarge"></i><p>'.$localization['main_order'].'</p><div class="uk-panel-badge uk-badge uk-badge-danger uk-animation-fade uk-animation-1-0">Neztrácejte čas</div>';
                        }else{
                            $orderLinkText = '<i class="uk-icon-cutlery uk-icon-extralarge"></i><p>'.$localization['main_order'].'</p>';
                        }
                        echo $this->Html->link($orderLinkText,
                        ['controller' => 'Menu', 'action' => 'index','restID' => $restaurant->ID,'lang'=>$language],
                        ['class' => 'uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover', 'escapeTitle' => false]
                    ); ?>
                </div>
            </li>
            <li class="uk-grid-margin">
                <div>
                    <a class="uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover" href="javascript:;"
                       onclick="createNewNotification()">
                        <i class="uk-icon-bell-o uk-icon-extralarge"></i>
                        <p><?=$localization['main_summon']?></p>
                        <?php
                        if($restaurant->configuration->ShowMainBadges):
                        ?>
                        <div class="uk-panel-badge uk-badge uk-badge-danger uk-animation-fade uk-animation-1-0">Potřebujete poradit?</div>
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
            </li>
            <li class="uk-grid-margin">
                <div>
                    <a class="uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover" href="#modal_note" data-uk-modal="{target:bgclose:false,center:true}">
                        <i class="uk-icon-comments uk-icon-extralarge"></i>
                        <p><?=$localization['main_opinion']?></p>
                        <?php
                        if($restaurant->configuration->ShowMainBadges):
                        ?>
                        <div class="uk-panel-badge uk-badge uk-badge-danger uk-animation-fade uk-animation-1-0">Byli jste spokojeni?</div>
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
            </li>
            <li class="uk-grid-margin">
                <div>
                    <a class="uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover" href="#modal_news" data-uk-modal="{target:bgclose:false,center:true}">
                        <i class="uk-icon-newspaper-o uk-icon-extralarge"></i>
                        <p><?=$localization['main_news']?></p>
                        <?php
                        if($restaurant->configuration->ShowMainBadges):
                        ?>
                        <div class="uk-panel-badge uk-badge uk-badge-danger uk-animation-fade uk-animation-1-0">Už víte co je nového?</div>
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
            </li>
            <li class="uk-grid-margin">
                <div>
                    <a class="uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover" href="#modal_guest_config" data-uk-modal="{target:bgclose:false,center:true}">
                        <i class="uk-icon-cogs uk-icon-extralarge"></i>
                        <p><?=$localization['main_configuration']?></p>
                        <?php
                        if($restaurant->configuration->ShowMainBadges):
                        ?>
                        <div class="uk-panel-badge uk-badge uk-animation-fade uk-animation-1-0">Upravte si WiFiČíšníka</div>
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
            </li>
            <li class="uk-grid-margin">
                <div>
                    <a class="uk-panel uk-panel-box uk-panel-box-primary uk-panel-box-primary-hover" href="<?= $restaurant->WebUrl?>" target="_blank">
                        <i class="uk-icon-globe uk-icon-extralarge"></i>
                        <p><?=$localization['main_internet']?></p>
                        <?php
                        if($restaurant->configuration->ShowMainBadges):
                        ?>
                        <div class="uk-panel-badge uk-badge uk-badge-danger uk-animation-fade uk-animation-1-0">Prozkoumejte svět</div>
                        <?php
                        endif;
                        ?>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
<?= $this->element('modals');?>

<?= $this->fetch('placeid_modal') ?>
<?= $this->fetch('note_modal') ?>
<?= $this->fetch('news_modal') ?>
<?= $this->fetch('guest_config_modal') ?>

<?= $this->element('scripts');?>
<?= $this->fetch('restaurant_main') ?>

