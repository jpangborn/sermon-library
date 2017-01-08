<section class="box">
	<header>
		<h2>Browse by Series</h2>
	</header>
	<ul class="style3">
		<?php foreach($series_list as $series): ?>
		<li><a href="<?= $series->url() ?>"><?= $series->title() ?></a></li>
		<?php endforeach ?>
	</ul>
</section>
