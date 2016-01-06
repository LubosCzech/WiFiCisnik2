<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'WiFi Číšník 2.2b';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, maximum-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!--?= $this->Html->css('base.css') ?-->
    <!--?= $this->Html->css('cake.css') ?-->
    <?= $this->Html->css('uikit.almost-flat.css') ?>
    <?= $this->Html->css('uikit.css') ?>
    <?= $this->Html->css('components/notify.almost-flat.min.css') ?>
    <?= $this->Html->css('components/tooltip.almost-flat.min.css') ?>
    <!--?= $this->Html->css('components/form-advanced.almost-flat.css') ?-->
    <?= $this->Html->css('components/nestable.almost-flat.min.css') ?>
    <?= $this->Html->css('custom.css') ?>

    <?= $this->Html->script('jquery-2.1.4.min'); ?>
    <?= $this->Html->script('uikit'); ?>
    <?= $this->Html->script('components/notify.min'); ?>
    <?= $this->Html->script('components/nestable.min'); ?>
    <?= $this->Html->script('autorefresh.js');?>
    <?= $this->Html->script('starrating.js');?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="uk-height-viewport uk-width-1-1">
    <!--nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
    </nav-->
    <div id="wrap">
    <?php
    if (isset($restaurant)&& !is_null($restaurant)){
        echo $this->element('header', ["restaurant" => $restaurant,"cakeDescription"=>$cakeDescription]);
    }
    ?>
    </div>
    <?= $this->Flash->render() ?>
    <section class="container clearfix">
        <?= $this->fetch('content') ?>
    </section>
    <footer>
    </footer>
</body>
</html>
