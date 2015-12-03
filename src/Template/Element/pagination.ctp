<?php
if (!isset($separator)) {
    if (defined('PAGINATOR_SEPARATOR')) {
        $separator = PAGINATOR_SEPARATOR;
    } else {
        $separator = '';
    }
}
if (empty($first)) {
    $first = __d('tools', 'first');
}
if (empty($last)) {
    $last = __d('tools', 'last');
}
if (empty($prev)) {
    $prev = __d('tools', 'previous');
}
if (empty($next)) {
    $next = __d('tools', 'next');
}
if (!isset($format)) {
    $format = __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total');
}
if (!empty($reverse)) {
    $tmp = $first;
    $first = $last;
    $last = $tmp;
    $tmp = $prev;
    $prev = $next;
    $next = $tmp;
}
if (!empty($addArrows)) {
    $prev = '« ' . $prev;
    $next .= ' »';
}
$escape = isset($escape) ? $escape : true;
?>

    <ul class="uk-pagination" id="pagination-<?= $modelName ?>">
        <?= $this->Paginator->prev('' . __('Předchozí'), array('class' => 'uk-pagination-previous', 'model' => $modelName)) ?>
        <?= $this->Paginator->numbers(['model' => $modelName]) ?>
        <?= $this->Paginator->next(__('Další') . '', array('class' => 'uk-pagination-next', 'model' => $modelName)) ?>
    </ul>

<?php if (!empty($options['ajaxPagination'])) {
    $ajaxContainer = !empty($options['paginationContainer']) ? $options['paginationContainer'] : '.page';
    $urlParams = !empty($options['urlParams']) ? $options['urlParams'] : '';
    $script = "$(document).ready(function() {
	$('#pagination-$modelName a').on('click', function () {
		$('$ajaxContainer').fadeTo(300, 0);
		var thisHref = $(this).attr('href');
		if(thisHref==''){
		thisHref = window.location.href + '?page=1';
		}
		 $('$ajaxContainer').load(thisHref+'$urlParams'+'&model='+'$modelName', function() {
			$(this).fadeTo(200, 1);
			$('html, body').animate({
				scrollTop: $('$ajaxContainer').offset().top
			}, 200);
		});
		return false;
	});
});";
    echo('<script language="JavaScript">' . $script . '</script>');
} ?>