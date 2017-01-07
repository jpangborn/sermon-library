<?php snippet('html-start') ?>

  <body class="no-sidebar">
    <div id="page-wrapper">

      <!-- Header -->
      <?php snippet('header', array('verse' => false)) ?>

      <!-- Main -->
				<div class="wrapper style2">
					<div class="title"><?= $page->title()->html() ?></div>
					<div id="main" class="container">
						<div class="row 150%">
							<div class="8u 12u(mobile)">

                <!-- Content -->
									<div id="content">
										<article class="box post">
											<?php snippet('page-header') ?>

                			<h2 class="sermon-series">Series: <?= $site->pages()->findByURI($page->series())->title() ?></h2>

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
                  </div>

              </div>
              <div class="4u 12u(mobile)">

                <!-- Sidebar -->
  								<div id="sidebar">

                  </div>
              </div>
            </div>
          </div>
        </div>

      <!-- Footer -->
      <?php snippet('footer') ?>
    </div>

<?php snippet('html-end') ?>
