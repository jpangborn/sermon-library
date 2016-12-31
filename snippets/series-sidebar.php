<section class="box">
	<header>
		<h2>Browse by Series</h2>
	</header>
	<ul class="style3">
		<?php foreach($page->grandchildren()->visible()->filterBy('template', 'series')->flip() as $series): ?>
		<li><a href="<?= $series->url() ?>"><?= $series->title() ?></a></li>
		<?php endforeach ?>
	</ul>
</section>
