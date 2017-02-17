<?php

echo $sermons->podcast(array(
    'title'               => $page->podcast_title(),
    'subtitle'            => $page->podcast_subtitle(),
    'description'         => $page->podcast_description(),
    'author'              => site()->users()->find($page->podcast_author())->name(),
    'image'               => $page->podcast_image(),
    'category'				    => $page->podcast_itunes_category(),
    'subcategory' 		    => $page->podcast_itunes_subcategory(),
    'explicit'				    => 'Clean',
    'language'				    => 'en-us',
    'copyright'			      => $page->podcast_copyright(),
    'lastBuildDate'       => date(DateTime::RFC822),
    'owner_name'			    => site()->users()->find($page->podcast_owner())->name(),
    'owner_email' 		    => site()->users()->find($page->podcast_owner())->email(),
    'generator'			      => c::get('slk.generator', 'Sermon Library for Kirby'),
    'docs'						    => 'http://www.apple.com/itunes/podcasts/specs.htm',
    'datefield'			      => 'date',
    'header'					    => true));
