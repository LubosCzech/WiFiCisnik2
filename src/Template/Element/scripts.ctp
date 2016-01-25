<?php $this->start('restaurant_main'); ?>
<script language="JavaScript">
    <?php
    if (!isset($isPaymentNotify)){
        $isPaymentNotify = 'false';
    }
    ?>
    var allow_refresh = true;
    var refresh_rate = 1740; //Autorefresh page if  no activity for  29minutes
    var placeID = null;
    var isPaymentNotify = <?= $isPaymentNotify?>;
    if (isPaymentNotify) {
        var paymentState = <?php if(isset($paymentState) && !is_null($paymentState)) echo $paymentState; else echo '0';?>;

        if (paymentState == 3) {
            UIkit.notify("<i class='uk-icon-check'></i> <?=$localization['note_order_complete']?>", {status: 'success'});
        }

        if (paymentState == 6) {
            UIkit.notify("<i class='uk-icon-warning'></i> <?=$localization['note_order_error']?></br><?= $resultText?>", {status: 'danger'})
        }
    }

    function createNewNotification() {
        <?php
        if (!isset($currentUser)){
            $url_notification = null;
            $alter_url_notification = $this->Url->build([
                "controller" => "Restaurant",
                "action" => "createnotificationajax",
                "_ext" => "json"
            ]);
        }else{
            $url_notification = $this->Url->build([
                "controller" => "Restaurant",
                "action" => "createnotificationajax",
                "_ext" => "json"
            ]);
            $alter_url_notification = null;

            $url_notification=$url_notification.'?Guest_ID='.$currentUser->ID.'&Place_ID='.$currentUser->Place_ID;
        }
        ?>
        var targeturl = "<?= $url_notification?>";
        if (targeturl == "") {
            var modal = UIkit.modal("#modal_placeid");
            modal.bgclose = false;
            modal.center = true;
            modal.show();
        } else {
            sendNotification(targeturl);
        }
    }

    function notifyWithID() {
        placeID = document.getElementById("input_placeid").value;
        var modal = UIkit.modal("#modal_placeid");
        modal.hide();
        var targetUrl = "<?=$alter_url_notification?>";
        targetUrl = targetUrl + "?Guest_ID=0&Place_ID=" + placeID;
        sendNotification(targetUrl);

    }

    function sendNotification(targetUrl) {
        $.ajax({
            type: 'get',
            url: targetUrl,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> <?=$localization['note_summon_done']?>", {status: 'success'});
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    $('#star_question1').raty();
    $('#star_question2').raty();
    $('#star_question3').raty();
    $('#star_question4').raty();
    $('#star_question5').raty();

    function sendRate(){


        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "rateajax","_ext" => "json"]);?>';

        var name = document.getElementById("input_name").value;
        var comment = document.getElementById("area_comment").value;
        var question1 =  $('#star_question1').raty('score');
        var question2 =  $('#star_question2').raty('score');
        var question3 =  $('#star_question3').raty('score');
        var question4 =  $('#star_question4').raty('score');
        var question5 =  $('#star_question5').raty('score');

        if(document.getElementById("question1")!=null){
            document.getElementById("question1").value = question1;
        }
        if(document.getElementById("question2")!=null){
            document.getElementById("question2").value = question2;
        }
        if(document.getElementById("question3")!=null){
            document.getElementById("question3").value = question3;
        }
        if(document.getElementById("question4")!=null){
            document.getElementById("question4").value = question4;
        }
        if(document.getElementById("question5")!=null){
            document.getElementById("question5").value = question5;
        }
        var data = $('#form_rating').serialize();

        //reset all
        $('#star_question1').raty('reload');
        $('#star_question2').raty('reload');
        $('#star_question3').raty('reload');
        $('#star_question4').raty('reload');
        $('#star_question5').raty('reload');
        document.getElementById("input_name").value="";
        document.getElementById("area_comment").value="";
        if(document.getElementById("question1")!=null){
            document.getElementById("question1").value = "";
        }
        if(document.getElementById("question2")!=null){
            document.getElementById("question2").value = "";
        }
        if(document.getElementById("question3")!=null){
            document.getElementById("question3").value = "";
        }
        if(document.getElementById("question4")!=null){
            document.getElementById("question4").value = "";
        }
        if(document.getElementById("question5")!=null){
            document.getElementById("question5").value = "";
        }

        //close modal
        var modal = UIkit.modal("#modal_note");
        modal.hide();

        console.log(name+" "+comment+" "+question1+" "+question2+" "+question3+" "+question4+" "+question5);

        $.ajax({
            type: 'post',
            url: targetUrl,
            data:  data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> <?=$localization['note_rating_done']?>", {status: 'success'});
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function saveGuestConfig(){

        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "saveconfigguestajax","_ext" => "json"]);?>';


        var data = $('#form_guest_config').serialize();

        //close modal
        var modal = UIkit.modal("#modal_guest_config");
        modal.hide();



        $.ajax({
            type: 'post',
            url: targetUrl,
            data:  data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> <?=$localization['note_config_save']?>", {status: 'success'});
                setTimeout(function(){
                    location.reload(true);
                }, 2000);
            },
            error: function (e) {
                console.log(e);
            }
        });
    }

    function removeGuestPlace(){
        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "removeplaceguestajax","_ext" => "json"]);?>';


        var data = $('#form_guest_config').serialize();

        //close modal
        var modal = UIkit.modal("#modal_guest_config");
        modal.hide();



        $.ajax({
            type: 'post',
            url: targetUrl,
            data:  data,
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> <?=$localization['note_leave_place']?>", {status: 'success'});
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
</script>
<?php $this->end(); ?>

<?php $this->start('restaurant_admin');?>
    <script language="JavaScript">
    function saveMenu(){
        var targetUrl='<?=$this->Url->build(["controller" => "Restaurant","action" => "savemenuajax","_ext" => "json"]);?>';

        var data = $("#menu_tree").data("nestable").serialize();

        $.ajax({
            type: 'post',
            url: targetUrl,
            data:  {list: data},
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function (response) {
                UIkit.notify("<i class='uk-icon-info'></i> Menu bylo úspěšně uloženo", {status: 'success'});
            },
            error: function (e) {
                console.log(e);
            }
        });
    }
    </script>
<?php $this->end();?>