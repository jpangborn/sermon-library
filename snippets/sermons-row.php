<div class="row 150%">
  <?php foreach($sermons as $sermon): ?>
	<div class="6u 12u(mobile)">
		<section class="box">
			<header>
				<h2><?= $sermon->title()->html() ?></h2>
        <p>Series: <?= $site->pages()->findByURI($sermon->series())->title() ?></p>
			</header>
      <audio class="sermon-audio" controls>
    		<?php if($audio = $sermon->audio()->filterBy('extension', 'mp3')->first()): ?>
    		<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
    		<?php endif ?>
    	</audio>
      <?php $teacher = $site->users()->find($sermon->teacher()) ?>
    	<p>
        Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?><br>
        on <?= $sermon->date('l, F j, Y') ?>
      </p>
			<a href="#" class="button style1">View Details</a>
		</section>
	</div>
  <?php endforeach ?>
</div>
