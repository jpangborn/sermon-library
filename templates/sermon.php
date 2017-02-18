<?php snippet('html-start') ?>

  <body class="right-sidebar">
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
                      </header>
                      <?php if(!page->series()-empty()): ?>
                        <?php if(!$series->cover()->empty()): ?>
                        <a href="#" class="image featured">
                          <img src="<?= $series->image($series->cover())->url() ?>">
                        </a>
                        <?php endif ?>
                      <?php endif ?>

                			<audio controls>
                				<?php if($audio = $page->audio()->filterBy('extension', 'mp3')->first()): ?>
                				<source src="<?= $audio->url() ?>" type="<?= $audio->mime() ?>">
                				<?php endif ?>
                			</audio>

                      <p>
                        Taught by <?= $teacher->firstname() ?> <?= $teacher->lastname() ?> on <?= $page->date('l, F j, Y') ?><br>
                        Series: <?= $series->title() ?>
                      </p>

                			<?php if(!$page->description()->empty()): ?>
                			<h2>Description</h2>
                			<?= $page->description()->kirbytext() ?>
                			<?php endif ?>

                			<h2>Scripture Covered</h2>
                			<?php foreach($page->passagesDescriptions() as $passage): ?>
                				<h3><?= $passage ?></h3>
                				<?= $page->passageText($passage) ?>
                			<?php endforeach ?>
                    </article>
                  </div>

              </div>
              <div class="4u 12u(mobile)">

                <!-- Sidebar -->
  								<div id="sidebar">
                    <?php $series_list = page($kirby->get('option', 'slk.main.uri'))->grandchildren()->visible()->filterBy('template', 'series')->flip() ?>
                    <?php snippet('series-sidebar', array('series_list' => $series_list)) ?>
                  </div>
              </div>
            </div>
          </div>
        </div>

      <!-- Footer -->
      <?php snippet('footer') ?>
    </div>

<?php snippet('html-end') ?>
