<?php snippet('html-start') ?>

  <body class="left-sidebar">
    <div id="page-wrapper">

      <!-- Header -->
      <?php snippet('header', array('verse' => false)) ?>

      <div class="wrapper style2">
        <div class="title"><?= $page->title()->html() ?></div>
        <div id="main" class="container">
          <div class="row 150%">
            <div class="4u 12u(mobile)">

              <!-- Sidebar -->
                <div id="sidebar">
                  <header>
                		<h2>Search Sermons</h2>
                	</header>

                  <form method="post" action="#">
                    <div class="row">
                      <div class="12u">
                        <input type="text" name="q" id="search-query" placeholder="Search..." value="<?= r($results, esc($results->query())) ?>">
                      </div>
                    </div>
                    <div class="row">
                      <div class="12u">
                        <ul class="actions">
                            <li><input type="submit" class="style1" value="Search"></li>
                        </ul>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
            <div class="8u 12u(mobile)">

            <!-- Content -->
              <div id="content">
                <article class="box post">
                  <?php snippet('page-header') ?>

                  <header class="style1">
                    <h2>Results</h2>
                  </header>

                  <?php foreach($results as $result): ?>
                    <div class="row">
                      <div class="12u">
                        <a href="<?= $result->url() ?>"><h2><?= html($result->title()) ?></h2></a>
                        <p>Part of the <?= $result->series() ?> series. Taught by <?= $result->teacher() ?> on <?= $result->date('F j, Y') ?>.</p>
                      </div>
                    </div>
                  <?php endforeach ?>

                  <ul class="actions actions-centered">
                    <?php if($pagination->hasPrevPage()): ?>
                    <li>
                      <a href="<?php echo $pagination->prevPageUrl() ?>" class="button style1">Previous Results</a>
                    </li>
                    <?php endif ?>

                    <?php if($pagination->hasNextPage()): ?>
                    <li>
                      <a href="<?php echo $pagination->nextPageUrl() ?>" class="button style1">More Results</a>
                    </li>
                    <?php endif ?>
                  </ul>
                </article>
              </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <?php snippet('footer') ?>
    </div>

<?php snippet('html-end') ?>
