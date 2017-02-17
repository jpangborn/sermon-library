<?php $sermons = $page->grandChildren()->visible()->filterBy('template', 'sermon')->flip()->limit(25) ?>

<?php

  $sermons->podcast(array(
    'title'               => $page->podcastTitle(),
    'subtitle'            => $page->podcastSubtitle(),
    'description'         => $page->podcastDescription(),
    'author'              => site()->user($page->podcastAuthor())->name(),
    'image'               => $page->podcastImage(),
    'category'				    => $page->podcastItunesCategory(),
    'subcategory' 		    => $page->podcastItunesSubcategory(),
    'explicit'				    => 'Clean',
    'language'				    => 'en-us',
    'copyright'			      => $page->podcastCopyright(),
    'lastBuildDate'       => date(DateTime::RFC822),
    'owner_name'			    => site()->user($page->podcastOwner())->name(),
    'owner_email' 		    => site()->user($page->podcastOwner())->email(),
    'generator'			      => c::get('slk.generator', 'Sermon Library for Kirby'),
    'docs'						    => 'http://www.apple.com/itunes/podcasts/specs.htm',
    'datefield'			      => 'date',
    'header'					    => true));
?>
