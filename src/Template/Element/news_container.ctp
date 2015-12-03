<div class="uk-panel uk-panel-box uk-panel-box-secondary">
    <div class="uk-panel-badge">
        <?= $this->Form->button('Přidat', ['class' => 'uk-button uk-button-primary','data-uk-modal'=>"{target:'#modal_news_edit',bgclose:false,center:true}"]) ?>
    </div>
    <table cellpadding="0" cellspacing="0" class="uk-table uk-table-striped uk-text-extralarge uk-height-1-1">
        <thead>
        <tr>
            <th>Titulek</th>
            <th>Text</th>
            <th>Vytvořeno</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($news as $news): ?>
            <tr>
                <td><?= h(mb_substr($news->Title,0,8,"UTF-8")) ?></td>
                <td><?= h(mb_substr($news->Text,0,40,"UTF-8")) ?></td>
                <td><?= h($news->Created) ?></td>
                <td class="actions">
                    <a href="#modal_news_edit"
                       id="news_link"
                       name="news_link_<?= $news->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $news->ID ?>"
                       data-title="<?= $news->Title?>"
                       data-text="<?= $news->Text?>"
                        ><i class="uk-icon-edit uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $news->ID ?>"
                            data-title="<?= $news->Title?>"
                            data-text="<?= $news->Text?>"
                            ></i></a>
                </td>
                <td class="actions">
                    <a href=""
                       id="news_remove"
                       name="news_remove_link_<?= $news->ID ?>"
                       data-uk-modal="{center:true,bgclose:false}"
                       data-id="<?= $news->ID ?>"
                        ><i class="uk-icon-trash-o uk-icon-medium"
                            data-uk-modal="{center:true,bgclose:false}"
                            data-id="<?= $news->ID ?>"
                            ></i></a>

                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>