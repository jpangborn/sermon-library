<div class="row 150%">
  <?php foreach($sermons as $sermon) ?>
	<div class="6u 12u(mobile)">
		<section class="box">
			<header>
				<h2><?= $sermon->title()->html() ?></h2>
			</header>
      <audio class="sermon-audio" controls>
    		<?php if($audio = $sermon->audio()->filterBy('extension', 'mp3')->first()): ?>
    		<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
    		<?php endif ?>
    	</audio>
      <?php $teacher = $site->users()->find($sermon->teacher()) ?>
    	<p>Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?> on <?= $sermon->date('l, F j, Y') ?></p>
			<a href="<?= $sermon->url() ?>" class="button style1">More</a>
		</section>
	</div>
  <?php endforeach ?>
</div>
