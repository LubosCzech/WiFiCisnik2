<section id="menu-bottom" class="uk-animation-slide-bottom">
    <nav class="uk-navbar uk-margin-bottom">

        <ul class="uk-navbar-nav">
            <li>
                <?php echo $this->Html->link(
                    '<i class="uk-icon-home uk-icon-medium"></i> '.$localization['txt_home'],
                    ['controller' => 'Restaurant', 'action' => 'main', $restaurant->Code],
                    ['escapeTitle' => false]
                ); ?>
            </li>
        </ul>

        <div class="uk-navbar-flip">
            <ul class="uk-navbar-nav">
                <li id="cart-menu">
                    <?php
                    echo $this->Html->link(
                        '<i class="uk-icon-shopping-cart uk-icon-medium"></i> '.$localization['txt_cart'],
                        '#modal_cart',
                        ['escapeTitle' => false, 'data-uk-modal' => '{center:true,bgclose:false}', 'class' => 'uk-text-danger uk-hidden', 'id' => 'cart-link']
                    );
                    ?>
                </li>
            </ul>
        </div>

        <div class="uk-navbar-content uk-navbar-center">WiFi Číšník 2.2b</div>

    </nav>
</section>
<div class="uk-tooltip uk-tooltip-top-right uk-notify-message-extradanger uk-hidden uk-animation-fade" id="tooltip"
     style="visibility: visible; display: block;">
    <div class="uk-tooltip-inner"><?=$localization['txt_finish_order']?></div>
</div>