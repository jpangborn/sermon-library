<?php snippet('header') ?>

  <main class="ccl-main" role="main">
		
    <h1><?= $page->title()->html() ?></h1>
		
    <?php foreach(page(c::get('slk.main.uri'))->grandChildren()->visible()->filterBy('template', 'slk_sermon')->filterBy('series', $page->uri()) as $sermon): ?>
    <?php snippet('sermon', array('sermon' => $sermon)) ?>
    <?php endforeach ?>
  </main>

<?php snippet('footer') ?>