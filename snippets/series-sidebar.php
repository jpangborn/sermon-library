<sidebar class="series-sidebar">
	<h2>Browse by Series</h2>
	<ul class="series-list">
	<?php foreach($page->grandchildren()->visible()->filterBy('template', 'slk_series') as $series): ?>
		<li><a href="<?= $series->url() ?>"><?= $series->title() ?></a></li>
	<?php endforeach ?>
	</ul>
</sidebar>