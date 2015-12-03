<div class="uk-width-small-1-6">
    <ul class="uk-nav uk-nav-side" data-uk-tab="{connect:'#admin-menu', animation: 'fade'}">
        <li><a href="">Produkty</a></li>
        <li><a href="">Kategorie</a></li>
        <li><a href="">Menu</a></li>
    </ul>
</div>

<div class="uk-width-8-10">
    <ul id="admin-menu" class="uk-switcher">
        <li>
            <div id="product-container">
                <?php echo $this->element('product_container'); ?>
            </div>
        </li>
        <li>
            <div id="category-container">
                <?php echo $this->element('category_container'); ?>
            </div>
        </li>
        <li>
            <div id="menu-container">
                <?php echo $this->element('menu_container'); ?>
            </div>
        </li>
    </ul>
</div>