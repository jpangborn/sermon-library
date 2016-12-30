<?php snippet('header') ?>

  <main class="ccl-main" role="main">
		
    <h1><?= $page->title()->html() ?></h1>
       
    <?php snippet('series-sidebar') ?>
 
		<h2>Recent Sermons</h2>
		
    <?php foreach($page->grandChildren()->visible()->filterBy('template', 'slk_sermon')->flip() as $sermon): ?>
    <?php snippet('sermon', array('sermon' => $sermon)) ?>
    <?php endforeach ?>
  </main>

<?php snippet('footer') ?>