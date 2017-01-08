<?php snippet('html-start') ?>

  <body class="right-sidebar">
    <div id="page-wrapper">

      <!-- Header -->
      <?php snippet('header', array('verse' => false)) ?>

      <!-- Main -->
				<div class="wrapper style2">
					<div class="title">Series Details</div>
					<div id="main" class="container">
						<div class="row 150%">
							<div class="8u 12u(mobile)">

                <!-- Content -->
									<div id="content">
										<article class="box post">
                      <header class="style1">
                        <h2><?= $page->title()->html() ?></h2>
                      </header>
                      <?php if(!$page->cover()->empty()): ?>
                      <a href="#" class="image featured">
                        <img src="<?= $page->image($page->cover())->url() ?>">
                      </a>
                      <?php endif ?>

                      <?php for($i = 0; $i < $series->count(); $i += 2): ?>
                        <? snippet('sermons-row', array('sermons' => $series->slice($i, 2))) ?>
                      <?php endfor ?>

                      <nav class="pagination">
                        <?php if($pagination->hasPrevPage()): ?>
                        <a href="<?php echo $pagination->prevPageUrl() ?>" class="button style2">Previous Sermons</a>
                        <?php endif ?>

                        <?php if($pagination->hasNextPage()): ?>
                        <a href="<?php echo $pagination->nextPageUrl() ?>" class="button style2">Next Sermons</a>
                        <?php endif ?>
                      </nav>
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
