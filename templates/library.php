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
                    </article>

                    <?php $sermons = $page->grandChildren()->visible()->filterBy('template', 'sermon')->flip()->limit(10) ?>
                    <?php for($i = 0; $i < $sermons->count(); $i += 2): ?>
                      <!-- Test -->
                      <? snippet('sermons-row', array('sermons' => $sermons->slice($i, 2))) ?>
                    <?php endfor ?>
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
