<?php snippet('html-start') ?>

  <body class="no-sidebar">
    <div id="page-wrapper">

      <!-- Header -->
      <?php snippet('header', array('verse' => false)) ?>

      <!-- Main -->
				<div class="wrapper style2">
					<div class="title">Sermon Details</div>
					<div id="main" class="container">
						<div class="row 150%">
							<div class="8u 12u(mobile)">

                <!-- Content -->
									<div id="content">
										<article class="box post">
                      <header class="style1">
                        <h2><?= $page->title()->html() ?></h2>
                        <p>Series: <?= $series->title() ?></p>
                      </header>
                      <?php if(!$series->cover()->empty()): ?>
                      <a href="#" class="image featured">
                        <img src="<?= $series->image($series->cover())->url() ?>">
                      </a>
                      <?php endif ?>

                			<audio class="sermon-audio" controls>
                				<?php if($audio = $page->audio()->filterBy('extension', 'mp3')->first()): ?>
                				<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
                				<?php endif ?>
                			</audio>

                			<p>Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?> on <?= $page->date('l, F j, Y') ?></p>

                			<?php if(!$page->description()->empty()): ?>
                			<h4>Description</h4>
                			<?= $page->description()->kirbytext() ?>
                			<?php endif ?>

                			<h4>Scripture Covered</h4>
                			<ul>
                			<?php foreach($page->passagesDescriptions() as $passage): ?>
                				<li><?= $passage ?></li>

                				<?= $page->passageText($passage) ?>
                			<?php endforeach ?>
                			</ul>
                    </article>
                  </div>

              </div>
              <div class="4u 12u(mobile)">

                <!-- Sidebar -->
  								<div id="sidebar">
                    <?php snippet('series-sidebar') ?>
                  </div>
              </div>
            </div>
          </div>
        </div>

      <!-- Footer -->
      <?php snippet('footer') ?>
    </div>

<?php snippet('html-end') ?>
