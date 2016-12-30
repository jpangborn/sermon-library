<?php snippet('header') ?>

  <main class="ccl-main" role="main">
		
    <h1><?= $page->title()->html() ?></h1>
    
    <article class="sermon">
			<h4 class="sermon-series">Series: <?= $site->pages()->findByURI($page->series())->title() ?></h4>
		
			<audio class="sermon-audio" controls>
				<?php if($audio = $page->audio()->filterBy('extension', 'mp3')->first()): ?>
				<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
				<?php endif ?>
			</audio>
		
			<?php if(!$page->description()->empty()): ?>
			<h5 class="sermon-description">Description</h5>
			<?= $page->description()->kirbytext() ?>
			<?php endif ?>
		
			<h5 class="sermon-scripture">Scripture Covered</h5>
			<ul class="sermon-passages">
			<?php foreach($page->passagesDescriptions() as $passage): ?>
				<li><?= $passage ?></li>
				
				<?= $page->passageText($passage) ?>
			<?php endforeach ?>
			</ul> 
		
			<?php $teacher = $site->users()->find($page->teacher()) ?>
			<p class="sermon-info">Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?> on <?= $page->date('l, F j, Y') ?></p>
		</article>
		
	</main>

<?php snippet('footer') ?>