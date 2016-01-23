<!--Layout begin-->
<div id="wrap">
    <?php
    $anim_delay = 0;
    if ($isPlaceID == 'true') {
        foreach ($menu_tree as $category) {
            echo('<div class="uk-panel uk-panel-box uk-grid-small uk-padding-top-remove uk-padding-bottom-remove uk-animation-fade" style="animation-delay: ' . $anim_delay . 's">');
            $anim_delay += 0.2;
            echo('<ul class="uk-nav uk-nav-side uk-nav-parent-icon" data-uk-nav=""/>');
            if(count($menu_tree)<=2){
                echo('<li class="uk-parent uk-open" aria-expanded="true" name="catActive">');
            }else{
                echo('<li class="uk-parent" aria-expanded="false">');
            }
            echo('<a href="#" class="uk-text-large">' . $category->Name . '</a>');
            echo('<ul class="uk-nav-sub">');
            foreach ($category->Products as $product) {
                if ($product->ImageUrl != null) {
                    $imageUrl = $this->Url->assetUrl($product->ImageUrl, ['pathPrefix' => $img_path_prefix]);
                } else {
                    $imageUrl = $this->Url->assetUrl('placeholder.png', ['pathPrefix' => $img_path_prefix]);
                }
                echo(' <li class="uk-text-break uk-text-middle"><a href="#modal_product"
                               id="product_link"
                               class="uk-text-large uk-margin-small uk-width-4-6"
                               data-uk-modal="{center:true,bgclose:false}"
                               data-id="' . $product->ID . '"
                               data-img="' . $imageUrl . '"
                               data-name="' . $product->Name . '"
                               data-price="' . $product->Price . '"
                               data-desc="' . $product->Description . '"
                               data-category="' . $category->ID . '"
                               >' . $product->Name . '<span id="menu-product-price"
                               data-id="' . $product->ID . '"
                               data-img="' . $imageUrl . '"
                               data-name="' . $product->Name . '"
                               data-price="' . $product->Price . '"
                               data-desc="' . $product->Description . '"
                               data-category="' . $category->ID . '"
                               >' . $product->Price . ' ' . $restaurant->configuration->CurrencySign . '</span></a></li>');
            }
            echo('</ul>');
            echo('</li>');
            echo('</ul>');
            echo('</div>');
        }
    }
    ?>
    <div class="uk-clearfix" style="height: 40px"></div>
</div>
<?= $this->element('menu_bottom', ["isCart" => $isCart]) ?>
<!-- Layout end-->

<!-- Hidden begin -->

<!-- Hidden end -->

<!-- Modal begin -->
<?= $this->element('modals');?>
<?= $this->fetch('placeid_noclose_modal') ?>
<?= $this->fetch('product_modal') ?>
<?= $this->fetch('cart_modal') ?>
<!-- Modal end -->

<!-- JS begin -->
<div data-uk-observe>
    <script language="JavaScript">
        var allow_refresh = true;
        var refresh_rate = 120; //If user is non active for 2minutes, redirect to restaurant main page
        var redirectUrl = "<?=
        $this->Url->build([
        "controller" => "Restaurant",
        "action" => "main",
        $restaurant->Code
        ]);
        ?>";
        var isPlaceID = <?= $isPlaceID ?>;
        if (!isPlaceID) {
            var modal = UIkit.modal("#modal_placeid");
            modal.bgclose = false;
            modal.center = true;
            modal.show();
        }

        $( document ).ready(function() {
            var categoryCount = <?= count($menu_tree)?>;

            if (categoryCount<=2){
                var catActive = document.getElementsByName("catActive");
                var i;
                for (i = 0; i <	catActive.length; i++) {
                    var el=catActive[i].getElementsByTagName("div");
                    $(el).removeClass("uk-hidden"); 
                $(el).css("height","");
                }
            }
        });

        var isFirstEnter = <?= $isFirstEnter; ?>;
        if (isFirstEnter) {
            UIkit.notify("<i class='uk-icon-check'></i> <?=$localization['note_welcome']?> <?= $cookieHelper->read('WiFiCisnik.PlaceName');?>", {status: 'success'});
        }


        $('#modal_placeid').on({

            'hide.uk.modal': function () {
                console.log("Element is not visible.");
                var placeID = document.getElementById("input_placeid").value;
                console.log(placeID)
            }
        });

        $('#modal_cart').on({
            'show.uk.modal': function () {
                $("#tooltip").addClass("uk-hidden");
                var elm = $("#tooltip");
                var newone = elm.clone(true);
                elm.replaceWith(newone);
            }
            ,
            'hide.uk.modal': function () {
                if(typeof emptyCart === 'undefined'){
                    $('#tooltip').removeClass('uk-hidden uk-animation-reverse');
                    $('#tooltip').addClass('uk-animation-fade');
                    var elm = $("#tooltip");
                    var newone = elm.clone(true);
                    elm.replaceWith(newone);

                    setTimeout(function () {
                        $("#tooltip").addClass("uk-animation-reverse");
                        var elm = $("#tooltip");
                        var newone = elm.clone(true);
                        elm.replaceWith(newone);
                    }, 5000);
                }
            }
        });


        $(document).on('click', '#product_link', productLinkHandler);

        function productLinkHandler(e) {
            //get id from pressed button
            var product_id = $(e.target).data('id');
            var product_name = $(e.target).data('name');
            var product_price = $(e.target).data('price');
            var product_desc = $(e.target).data('desc');
            var product_img = $(e.target).data('img');
            var category_id = $(e.target).data('category');

            $('#modal_product').on({
                'uk.modal.show': function () {
                    $('h2', $(this)).html(product_name);
                    $('h3', $(this)).html('<?= $localization['txt_price'] ?>: ' + product_price + ' <?=h($restaurant->configuration->CurrencySign);?>');
                    $('p', $(this)).html(product_desc);
                    if (product_img) {
                        $('img', $(this)).attr('src', product_img);
                    }
                    $('input[name=product_id]', $(this)).attr('value', product_id);
                    $('input[name=category_id]', $(this)).attr('value', category_id);
                    document.getElementById('product_count').value = 1;

                },
                'uk.modal.hide': function () {
                    //hide modal
                }
            }).trigger('uk.modal.show');
        }

        function checkAndSavePlaceID() {
            var placeID = document.getElementById("input_placeid").value;
            var validPlaceIDs = <?= json_encode($validPlaces); ?>;
            if (validPlaceIDs.indexOf(placeID) != -1) {
                setCookie("WCPID", placeID, 30);
                modal.hide();
                location.reload();

            } else {
                UIkit.notify("<i class='uk-icon-warning'></i> <?=$localization['note_wrong_code']?>", {status: 'danger'});
            }

        }

        function setCookie(cname, cvalue, exmins) {
            var d = new Date();
            d.setTime(d.getTime() + (exmins * 60 * 1000));
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        function decrementCount() {
            var value = parseInt(document.getElementById('product_count').value, 10);
            value = isNaN(value) ? 0 : value;
            if (value > 1) {
                value--;
            }
            document.getElementById('product_count').value = value;
        }
        function incrementCount() {
            var value = parseInt(document.getElementById('product_count').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('product_count').value = value;
        }

        $(document).on('click', '#product_remove', productRemoveLinkHandler);

        function productRemoveLinkHandler(e) {
            //get id from pressed button
            var product_id = $(e.target).data('id');

            //var thisHref = window.location.href + "?product_id=" + product_id + "&remove=1";
            var thisHref = "<?=
                    $this->Url->build([
                        "controller" => "Menu",
                        "action" => "index",
                        "remove" => 1
                    ]);
                ?>";
            thisHref = thisHref + "&product_id=" + product_id;
            $('#cart-container').load(thisHref, function () {
                $(this).fadeTo(200, 1);
            });
        }

        $(function () {  
            $(document).on('submit', '#modal-product-form', function (e) {
                var form = $(this);
                e.preventDefault();  
                var targeturl = "<?=
                    $this->Url->build([
                        "controller" => "Menu",
                        "action" => "addtocartajax",
                        "_ext" => "json",
                    ]);
                ?>";
                var post_url = form.attr('action');  

                $('#cart-container').load(post_url + "?add=1", form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> <?=$localization['note_product_added']?>", {status: 'success'});
                        var modal = UIkit.modal("#modal_product");
                        modal.hide();
                    }
                });
            })
        });


        $(document).ready( function() {
            $('#payMethod').bind('change', function (e) {
                if( $('#payMethod').val() == '3') {
                    $('#payMethodImg').removeClass('uk-hidden');
                }else{
                    $('#payMethodImg').addClass('uk-hidden');
                }
            }).trigger('change');
        });


        $(document).ready(function(){
            $('#input_placeid').keypress(function(e){
                if(e.keyCode==13)
                    $('#placeid_ent').click();
            });
        });

    </script>
</div>
<!--JS end -->