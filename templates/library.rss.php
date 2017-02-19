<?php

echo $sermons->podcast(array(
    'title'               => $page->podcast_title(),
    'subtitle'            => $page->podcast_subtitle(),
    'description'         => $page->podcast_description(),
    'link'                => $page->podcast_link(),
    'author'              => site()->users()->find($page->podcast_author())->firstName() . ' ' . site()->users()->find($page->podcast_author())->lastName(),
    'image'               => $page->image($page->podcast_image())->url(),
    'category'				    => $page->podcast_itunes_category(),
    'subcategory' 		    => $page->podcast_itunes_subcategory(),
    'explicit'				    => 'Clean',
    'language'				    => 'en-us',
    'copyright'			      => $page->podcast_copyright(),
    'lastBuildDate'       => date(DateTime::RFC822),
    'owner_name'			    => site()->users()->find($page->podcast_owner())->firstName() . ' ' . site()->users()->find($page->podcast_owner())->lastName(),
    'owner_email' 		    => site()->users()->find($page->podcast_owner())->email(),
    'generator'			      => c::get('slk.generator', 'Sermon Library for Kirby'),
    'docs'						    => 'http://www.apple.com/itunes/podcasts/specs.htm',
    'datefield'			      => 'date',
    'header'					    => true));
