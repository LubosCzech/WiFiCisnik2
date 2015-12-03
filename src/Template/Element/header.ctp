<div id="head" name="head" class="uk-animation-slide-top">
    <?= $this->Html->image($restaurant->LogoUrl, ['alt' => $cakeDescription, 'id' => 'logo_head']); ?>
    <p class="uk-article-lead">
        <?php
        if (isset($loggedUser) && !is_null($loggedUser)) {
            echo h($restaurant->configuration->AdminText);
        } else {
            echo h($restaurant->configuration->WelcomeText);
        }
        ?>
        <br/>
        <b><?= h($restaurant->Name) ?></b>

    <p>
</div>
<hr class="uk-grid-divider" id="divider">