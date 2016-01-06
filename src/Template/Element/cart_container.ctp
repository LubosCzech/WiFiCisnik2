<table class="uk-table uk-table-condensed">
    <thead>
    <tr>
        <th><?= $localization['txt_product'] ?></th>
        <th><?= $localization['txt_count'] ?></th>
        <th><?= $localization['txt_price'] ?></th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $cart_total_price = 0;
    if ($isCart === 'true') {
        foreach ($cart['Products'] as $product) {
            echo('<tr class="uk-text-middle uk-width-1-1">
                    <td class="uk-text-break uk-text-middle">' . $product->Name . '</td>
                    <td class="uk-text-nowrap uk-text-middle">' . $product->Count . '</td>
                    <td class="uk-text-nowrap uk-text-middle">' . $product->Count * $product->Price . ' ' . $restaurant->configuration->CurrencySign . '</td>
                    <td class="uk-text-middle"><a href="javascript:;" id="product_remove" data-id="' . $product->ID . '" class="uk-button uk-button-danger"><i class="uk-icon-minus" data-id="' . $product->ID . '"></i></a></td>
                </tr>');
            $cart_total_price += ($product->Count * $product->Price);
        }
    } else {
        if (isset($isEmpty) && $isEmpty) {
            echo('<script language="JavaScript"> ');
            echo('UIkit.notify("<i class=\'uk-icon-warning\'></i> '.$localization['note_cart_empty'].'", {status: \'warning\'});');
            echo('var modal = UIkit.modal("#modal_cart");
                   modal.hide();');
            echo('var emptyCart=true;');
            echo('</script>');
        }

    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th><?= $localization['txt_price_total'] ?></th>
        <th></th>
        <th><?= $cart_total_price ?> <?= $restaurant->configuration->CurrencySign ?></th>
        <th></th>
    </tr>
    </tfoot>
</table>

<script language="JavaScript">
    var isCart = <?= $isCart; ?>;

    if (isCart) {
        $('#cart-link').removeClass('uk-hidden');
        var modal = UIkit.modal("#modal_cart");
        if (!modal.isActive()) {
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
    } else {
        $('#cart-link').addClass('uk-hidden');
        $('#tooltip').addClass('uk-hidden');
    }
</script>