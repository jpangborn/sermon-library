<article class="sermon">
	<h3 class="sermon-title"><a href="<?= $sermon->url() ?>"><?= $sermon->title() ?></a></h3>
	<h4 class="sermon-series">Series: <?= $site->page($sermon->series())->title() ?></h4>

	<audio class="sermon-audio" controls>
		<?php if($audio = $sermon->audio()->filterBy('extension', 'mp3')->first()): ?>
		<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
		<?php endif ?>
	</audio>

	<h5 class="sermon-scripture">Scripture Covered</h5>
	<ul class="sermon-passages">
	<?php foreach($sermon->passagesDescriptions() as $passage): ?>
		<li><?= $passage ?></li>
	<?php endforeach ?>
	</ul>

	<?php $teacher = $site->users()->find($sermon->teacher()) ?>
	<p class="sermon-info">Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?> on <?= $sermon->date('l, F j, Y') ?></p>
</article>
