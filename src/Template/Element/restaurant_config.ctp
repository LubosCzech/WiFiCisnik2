<div class="uk-width-small-1-6">
    <ul class="uk-nav uk-nav-side" data-uk-tab="{connect:'#admin-rest-config', animation: 'fade'}">
        <li><a href="">Základní</a></li>
        <li><a href="">Rozšířené</a></li>
        <li><a href="">Pokladny</a></li>
        <li><a href="">Místa</a></li>
        <li><a href="">Uživatelé</a></li>
    </ul>
</div>

<div class="uk-width-8-10">
    <ul id="admin-rest-config" class="uk-switcher">
        <li>
            <div id="restaurant-container">
                <?php echo $this->element('restaurant_container'); ?>
            </div>
        </li>
        <li>
            <div id="restaurant-adv-container">
                <?php echo $this->element('restaurant_adv_container'); ?>
            </div>
        </li>
        <li>
            <div id="checkout-container">
                <?php echo $this->element('checkout_container'); ?>
            </div>
        </li>
        <li>
            <div id="place-container">
                <?php echo $this->element('place_container'); ?>
            </div>
        </li>
        <li>
            <div id="user-container">
                <?php echo $this->element('user_container'); ?>
            </div>
        </li>
    </ul>
</div>