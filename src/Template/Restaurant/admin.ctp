<div id="wrap">
    <ul class="uk-tab" data-uk-tab="{connect:'#wc2-admin', animation: 'slide-bottom'}">
        <li><a href="">Objednávky</a></li>
        <li><a href="">Archiv objednávek</a></li>
        <li><a href="">Jídelní lístek</a></li>
        <li><a href="">Nastavení restaurace</a></li>
        <li><a href="">Hodnocení</a></li>
        <li><a href="">Novinky</a></li>
    </ul>
    <?= $this->Form->hidden('ordersCount') ?>
    <div id="ordersCount"></div>
    <!-- This is the container of the content items -->
    <ul id="wc2-admin" class="uk-switcher uk-margin">
        <li>
            <div id="orders-container">
                <?php echo $this->element('orders_container'); ?>
            </div>
        </li>
        <li>
            <div id="archive-container">
                <?php echo $this->element('archive_container'); ?>
            </div>
        </li>
        <li>
            <div id="config-container" class="uk-grid">
                <?php
                if ($loggedUser->Role>1){
                    echo $this->element('menu_config');
                }else{
                    echo ('<div class="uk-alert uk-alert-danger uk-container-center uk-text-center uk-width-1-2" data-uk-alert><p>Nemáte dostatečná opravnění</p></div>');
                }
                ?>
            </div>
        </li>
        <li>
            <div id="config-restaurant-container" class="uk-grid">
                <?php
                if ($loggedUser->Role>1){
                    echo $this->element('restaurant_config');
                }else{
                    echo ('<div class="uk-alert uk-alert-danger uk-container-center uk-text-center uk-width-1-2" data-uk-alert><p>Nemáte dostatečná opravnění</p></div>');
                }
                ?>
            </div>
        </li>
        <li>
            <div id="rating-container">
                <?php
                if ($loggedUser->Role>1){
                    echo $this->element('rating_container');
                }else{
                    echo ('<div class="uk-alert uk-alert-danger uk-container-center uk-text-center uk-width-1-2" data-uk-alert><p>Nemáte dostatečná opravnění</p></div>');
                }
                ?>
            </div>
        </li>
        <li>
            <div id="news-container">
                <?php
                if ($loggedUser->Role>1){
                    echo $this->element('news_container');
                }else{
                    echo ('<div class="uk-alert uk-alert-danger uk-container-center uk-text-center uk-width-1-2" data-uk-alert><p>Nemáte dostatečná opravnění</p></div>');
                }
                ?>
            </div>
        </li>
    </ul>
</div>


<?= $this->element('modals');?>

<?= $this->fetch('order_modal') ?>
<?= $this->fetch('news_edit_modal') ?>
<?= $this->fetch('product_edit_modal') ?>
<?= $this->fetch('category_edit_modal') ?>
<?= $this->fetch('checkout_edit_modal') ?>
<?= $this->fetch('place_edit_modal') ?>
<?= $this->fetch('user_edit_modal') ?>

<?= $this->Html->media(
    array(
        'note.mp3',
        'note.ogg'
    ),
    array('id'=>'notify','preload'=>'auto')
); ?>

<?= $this->Html->media(
    array(
        'online.mp3',
        'online.ogg'
    ),
    array('id'=>'music','preload'=>'auto')
); ?>

<script language="javascript">
    var allow_refresh = true;
    var refresh_rate = 900; //Autorefresh page if no activity for  15minutes
    var redirectUrl = null;
    $(document).on('click', '#order_link', orderLinkHandler);
    $(document).on('click', '#news_link', newsLinkHandler);
    $(document).on('click', '#news_remove', newsRemoveLinkHandler);
    $(document).on('click', '#product_link', productLinkHandler);
    $(document).on('click', '#product_remove', productRemoveLinkHandler);
    $(document).on('click', '#category_link', categoryLinkHandler);
    $(document).on('click', '#category_remove', categoryRemoveLinkHandler);
    $(document).on('click', '#checkout_link', checkoutLinkHandler);
    $(document).on('click', '#checkout_remove', checkoutRemoveLinkHandler);
    $(document).on('click', '#place_link', placeLinkHandler);
    $(document).on('click', '#place_remove', placeRemoveLinkHandler);
    $(document).on('click', '#user_link', userLinkHandler);
    $(document).on('click', '#user_remove', userRemoveLinkHandler);

    checkAndNotifyNewOrder(true);

    function orderLinkHandler(e) {
        //get id from pressed button
        var order_id = $(e.target).data('id');
        var place = $(e.target).data('place');
        var orders = $(e.target).data('orders');
        var orders_count = orders.length;
        var order_state = $(e.target).data('state');
        //var product_img = $(e.target).data('img');

        $('#modal_order').on({
            'uk.modal.show': function () {
                var body = document.getElementById('orders_container');
                body.innerHTML = '';
                $('h2', $(this)).html('Objednávka č.' + order_id + ' [' + place + ']');
                //$('h3', $(this)).html('Cena: '+product_price+' Kč');
                //$('p', $(this)).html(product_desc);
                //$('img', $(this)).attr('src',product_img);
                $('input[name=order_id]', $(this)).attr('value', order_id);
                if (order_state == 5) {
                    $('button[name=process_order]', $(this)).hide();
                } else {
                    $('button[name=process_order]', $(this)).show();
                }

                for (x = 0; x < orders_count; x++) {
                    tableCreate(orders[x]);
                }

            },
            'uk.modal.hide': function () {
                //hide
            }
        }).trigger('uk.modal.show');
    }

    function tableCreate(order) {
        var body = document.getElementById('orders_container');
        var panel = document.createElement('div');
        panel.className='uk-panel uk-panel-box uk-panel-box-secondary uk-margin-bottom';
        var payment = document.createElement('div');
        payment.innerHTML=order.payment.Name;
        if(order.payment.Type=='1'){
            payment.className='uk-panel-badge uk-badge uk-badge-success';
        }else{
            payment.className='uk-panel-badge uk-badge uk-badge-danger';
        }
        var title = document.createElement('h3');
        title.className="uk-panel-title";
        title.innerHTML='Zákazník:' + order.Guest_ID + ' | Celkem:' + order.TotalPrice + ' <?=$restaurant->configuration->CurrencySign?>';
        var tbl = document.createElement('table');
        tbl.className = 'uk-table uk-text-large uk-table-striped uk-table-condensed';
        //Caption
        //var tcap = document.createElement('caption');
        //tcap.innerHTML = 'Zákazník:' + order.Guest_ID + '  Platba:' + order.payment.Name + '  Celkem:' + order.TotalPrice + 'Kč';
        //tbl.appendChild(tcap);
        //Theader
        var thead = document.createElement('thead');
        var thr = document.createElement('tr');
        var th = document.createElement('th');
        th.appendChild(document.createTextNode('Název'));
        thr.appendChild(th);
        th = document.createElement('th');
        th.appendChild(document.createTextNode('Počet'));
        thr.appendChild(th);
        th = document.createElement('th');
        th.appendChild(document.createTextNode('Cena'));
        thr.appendChild(th);
        thead.appendChild(thr);
        tbl.appendChild(thead);
        //Tbody
        var tbdy = document.createElement('tbody');
        for (i = 0; i < order.product.length; i++) {
            var tr = document.createElement('tr');
            tr.className='uk-text-nowrap uk-text';
            //Name
            var td = document.createElement('td');
            td.appendChild(document.createTextNode(order.product[i].Name));
            tr.appendChild(td);
            //Count
            td = document.createElement('td');
            td.appendChild(document.createTextNode(order.product[i]._joinData.Quantity));
            tr.appendChild(td);
            //Price
            td = document.createElement('td');
            td.appendChild(document.createTextNode(order.product[i]._joinData.PriceTotal+' <?=$restaurant->configuration->CurrencySign?>'));
            tr.appendChild(td);
            tbdy.appendChild(tr);


        }
        tbl.appendChild(tbdy);
        panel.appendChild(payment);
        panel.appendChild(title);
        panel.appendChild(tbl);
        //Note
        if(order.note!=null && order.note.Text!=null){
            var note = document.createElement('div');
            note.className='uk-panel uk-panel-box';
            var noteTitle = document.createElement('h3');
            noteTitle.className='uk-panel-title';
            noteTitle.innerHTML='Poznámka';
            note.appendChild(noteTitle);
            var noteText = document.createElement('div');
            noteText.innerHTML = order.note.Text;
            note.appendChild(noteText);
            panel.appendChild(note);
        }
        body.appendChild(panel)
    }

    function checkAndNotifyNewOrder(refresh) {
        var targeturl = "<?=
        $this->Url->build([
        "controller" => "Restaurant",
        "action" => "neworderscountajax",
        "_ext" => "json",
        "?" => ["ids" => urlencode(json_encode($allowedPlaces))]
        ]);
        ?>";
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                if (response.result) {
                    var result = response.result;
                    var newOrdersCount = result.newOrders;
                    var oldOrdersCount = document.getElementsByName("ordersCount")[0].value;


                    if (newOrdersCount > oldOrdersCount) {
                        if ((newOrdersCount - oldOrdersCount) == 1) {
                            UIkit.notify("<i class='uk-icon-warning'></i> Objednávka čeká na přijmutí...", {
                                status: 'extradanger',
                                timeout: 5000
                            });
                            toggleMusic(refresh);
                        }

                        if ((newOrdersCount - oldOrdersCount) > 1) {
                            UIkit.notify("<i class='uk-icon-warning'></i> Více [" + result.newOrders + "] nepřijmutých objednávek...", {
                                status: 'extradanger',
                                timeout: 5000
                            });
                            toggleMusic(refresh);
                        }
                        var thisHref = window.location.href + "?page=1&userID=<?=$loggedUser->ID?>&restaurantID=<?=$restaurant->ID?>";
                        $('#orders-container').load(thisHref, function () {
                            $(this).fadeTo(200, 1);
                        });
                    }
                    document.getElementsByName("ordersCount")[0].value = newOrdersCount;
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function checkAndShowNewNotifications() {
        var targeturl = "<?=
        $this->Url->build([
        "controller" => "Restaurant",
        "action" => "newnotificationsajax",
        "_ext" => "json",
        "?" => ["ids" => urlencode(json_encode($allowedPlaces))]
        ]);
        ?>";
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                if (response.result) {
                    var result = response.result;
                    var notifications = result.newNotifications;

                    for (i = 0; i < notifications.length; i++) {
                        UIkit.notify("<i class='uk-icon-phone'></i> " + notifications[i] + " volá obsluhu", {
                            status: 'danger',
                            timeout: 0
                        });
                        toggleNotify();
                    }
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function playMusicIfNotActive(){
        var ordersCount = document.getElementsByName("ordersCount")[0].value;
        if(ordersCount>=1 && last_user_action>=120){
            toggleMusic(false);
        }
    }

    function toggleMusic(refresh) {
        var music = document.getElementById('music');
        music.pause();
        if(!refresh){
            music.play();
        }
    }

    function toggleNotify() {
        var music = document.getElementById('notify');
        music.pause();
        music.play();
    }

    window.setInterval(function () {
        checkAndNotifyNewOrder(false);
        checkAndShowNewNotifications();
        playMusicIfNotActive();
    }, 30000);

    //NEWS section
    function saveNews(){
        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "savenewsajax","_ext" => "json"]);?>';
        var data = $('#form_news_edit').serialize();
        //reset all
        document.getElementById("title_text").value="";
        document.getElementById("news_text").value="";
        document.getElementById("news_id").value="";
        //close modal
        var modal = UIkit.modal("#modal_news_edit");
        modal.hide();
        //ajax post
        $.ajax({
            type: 'post',
            url: targetUrl,
            data:  data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> Novinka byla uložena", {status: 'success'});
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_news_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#news-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Novinka byla uložena", {status: 'success'});
                        var modal = UIkit.modal("#modal_news_edit");
                        modal.hide();
                        document.getElementById("title_text").value="";
                        document.getElementById("news_text").value="";
                        document.getElementById("news_id").value="";
                    }
                });
            })
    });

    function newsRemoveLinkHandler(e) {
        //get id from pressed button
        var news_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removenewsajax"]);?>';
        $('#news-container').load(targetUrl + "?news_id=" + news_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Novinka byla vymazána", {status: 'danger'});
            }
        });
    }

    function newsLinkHandler(e) {
        //get id from pressed button
        var news_id = $(e.target).data('id');
        var news_title = $(e.target).data('title');
        var news_text = $(e.target).data('text');

        $('#modal_news_edit').on({
            'uk.modal.show': function () {
                document.getElementById("title_text").value=news_title;
                document.getElementById("news_text").value=news_text;
                document.getElementById("news_id").value=news_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("title_text").value="";
                document.getElementById("news_text").value="";
                document.getElementById("news_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    //PRODUCT section
    function productLinkHandler(e) {
        //get id from pressed button
        var product_id = $(e.target).data('id');
        var product_name = $(e.target).data('name');
        var product_price = $(e.target).data('price');
        var product_description = $(e.target).data('description');
        var product_imageurl = $(e.target).data('imageurl');

        $('#modal_product_edit').on({
            'uk.modal.show': function () {
                document.getElementById("name_text").value=product_name;
                document.getElementById("description_text").value=product_description;
                document.getElementById("image_text").value=product_imageurl;
                document.getElementById("price_text").value=product_price;
                document.getElementById("product_id").value=product_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("name_text").value="";
                document.getElementById("description_text").value="";
                document.getElementById("image_text").value="";
                document.getElementById("price_text").value="";
                document.getElementById("product_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    function productRemoveLinkHandler(e) {
        //get id from pressed button
        var product_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removeproductajax"]);?>';
        $('#product-container').load(targetUrl + "?product_id=" + product_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Produkt byl vymazán", {status: 'danger'});
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_product_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#product-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Produkt byl uložen", {status: 'success'});
                        var modal = UIkit.modal("#modal_product_edit");
                        modal.hide();
                        document.getElementById("name_text").value="";
                        document.getElementById("description_text").value="";
                        document.getElementById("image_text").value="";
                        document.getElementById("price_text").value="";
                        document.getElementById("product_id").value="";
                    }
                });
            })
    });

    //CATEGORY section
    function categoryLinkHandler(e) {
        //get id from pressed button
        var category_id = $(e.target).data('id');
        var category_name = $(e.target).data('name');

        $('#modal_category_edit').on({
            'uk.modal.show': function () {
                document.getElementById("category_text").value=category_name;
                document.getElementById("category_id").value=category_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("category_text").value="";
                document.getElementById("category_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    function categoryRemoveLinkHandler(e) {
        //get id from pressed button
        var category_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removecategoryajax"]);?>';
        $('#category-container').load(targetUrl + "?category_id=" + category_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Kategorie byla vymazána", {status: 'danger'});
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_category_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#category-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Kategorie byla uložena", {status: 'success'});
                        var modal = UIkit.modal("#modal_category_edit");
                        modal.hide();
                        document.getElementById("category_text").value="";
                        document.getElementById("category_id").value="";
                    }
                });
            })
    });

    //CHECKOUT section
    function checkoutLinkHandler(e) {
        //get id from pressed button
        var checkout_id = $(e.target).data('id');
        var checkout_name = $(e.target).data('name');

        $('#modal_checkout_edit').on({
            'uk.modal.show': function () {
                document.getElementById("checkout_text").value=checkout_name;
                document.getElementById("checkout_id").value=checkout_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("checkout_text").value="";
                document.getElementById("checkout_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    function checkoutRemoveLinkHandler(e) {
        //get id from pressed button
        var checkout_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removecheckoutajax"]);?>';
        $('#checkout-container').load(targetUrl + "?checkout_id=" + checkout_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Pokladna byla vymazána", {status: 'danger'});
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_checkout_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#checkout-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Pokladna byla uložena", {status: 'success'});
                        var modal = UIkit.modal("#modal_checkout_edit");
                        modal.hide();
                        document.getElementById("checkout_text").value="";
                        document.getElementById("checkout_id").value="";
                    }
                });
            })
    });

    //PLACE section
    function placeLinkHandler(e) {
        //get id from pressed button
        var place_id = $(e.target).data('id');
        var place_name = $(e.target).data('name');
        var place_code = $(e.target).data('code');
        var place_checkout = $(e.target).data('checkout');

        $('#modal_place_edit').on({
            'uk.modal.show': function () {
                document.getElementById("place_text").value=place_name;
                document.getElementById("place_code").value=place_code;
                document.getElementById("place_checkout").value=place_checkout;
                document.getElementById("place_id").value=place_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("place_text").value="";
                document.getElementById("place_code").value="";
                document.getElementById("place_checkout").value="";
                document.getElementById("place_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    function placeRemoveLinkHandler(e) {
        //get id from pressed button
        var place_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removeplaceajax"]);?>';
        $('#place-container').load(targetUrl + "?place_id=" + place_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Místo bylo vymazáno", {status: 'danger'});
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_place_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#place-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Místo bylo uloženo", {status: 'success'});
                        var modal = UIkit.modal("#modal_place_edit");
                        modal.hide();
                        document.getElementById("place_text").value="";
                        document.getElementById("place_code").value="";
                        document.getElementById("place_checkout").value="";
                        document.getElementById("place_id").value="";
                    }
                });
            })
    });

    //RESTAURANT section
    $(function () {  
            $(document).on('submit', '#form_restaurant_main', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#restaurant-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Nastavení bylo uloženo", {status: 'success'});
                    }
                });
            })
    });

    $(function () {  
            $(document).on('submit', '#form_restaurant_config', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#restaurant-adv-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Nastavení bylo uloženo", {status: 'success'});
                    }
                });
            })
    });

    //USER section
    function userLinkHandler(e) {
        //get id from pressed button
        var user_id = $(e.target).data('id');
        var user_fullname = $(e.target).data('fullname');
        var user_login = $(e.target).data('login');
        var user_password = $(e.target).data('pwd');
        var user_role = $(e.target).data('role');
        var user_checkout = $(e.target).data('checkout');

        $('#modal_user_edit').on({
            'uk.modal.show': function () {
                document.getElementById("user_fullname").value=user_fullname;
                document.getElementById("user_login").value=user_login;
                document.getElementById("user_password").value=user_password;
                document.getElementById("user_role").value=user_role;
                document.getElementById("user_checkout").value=user_checkout;
                document.getElementById("user_id").value=user_id;

            },
            'uk.modal.hide': function () {
                //reset all
                document.getElementById("user_fullname").value="";
                document.getElementById("user_login").value="";
                document.getElementById("user_password").value="";
                document.getElementById("user_role").value="";
                document.getElementById("user_checkout").value="";
                document.getElementById("user_id").value="";
            }
        }).trigger('uk.modal.show');
    }

    function userRemoveLinkHandler(e) {
        //get id from pressed button
        var user_id = $(e.target).data('id');

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removeuserajax"]);?>';
        $('#user-container').load(targetUrl + "?user_id=" + user_id+"&restaurant_id="+"<?=$restaurant->ID?>", function (response, status, xhr) {
            if (status == 'success') {
                UIkit.notify("<i class='uk-icon-warning'></i> Uživatel byl smazán", {status: 'danger'});
            }
        });
    }

    $(function () {  
            $(document).on('submit', '#form_user_edit', function (e) {
                var form = $(this);
                e.preventDefault();  
                var post_url = form.attr('action');  

                $('#user-container').load(post_url, form.serialize(), function (response, status, xhr) {
                    if (status == 'success') {
                        UIkit.notify("<i class='uk-icon-check'></i> Uživatel byl uložen", {status: 'success'});
                        var modal = UIkit.modal("#modal_user_edit");
                        modal.hide();
                        document.getElementById("user_fullname").value="";
                        document.getElementById("user_login").value="";
                        document.getElementById("user_password").value="";
                        document.getElementById("user_role").value="";
                        document.getElementById("user_checkout").value="";
                        document.getElementById("user_id").value="";
                    }
                });
            })
    });

</script>