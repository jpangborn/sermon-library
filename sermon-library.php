<?php
  require __DIR__ . DS . 'vendor' . DS . 'autoload.php';

  use \CloudConvert\Api;
  use \CloudConvert\Process;

  // Load Dependencies
  load([
    'slk\\sermonpage'  => __DIR__ . DS . 'models' . DS . 'sermon.php'
  ]);

  // Blueprints
  $kirby->set('blueprint', 'library',         __DIR__ . DS . 'blueprints' . DS . 'library.yml');
  $kirby->set('blueprint', 'series-list',     __DIR__ . DS . 'blueprints' . DS . 'series-list.yml');
  $kirby->set('blueprint', 'series',          __DIR__ . DS . 'blueprints' . DS . 'series.yml');
  $kirby->set('blueprint', 'year',            __DIR__ . DS . 'blueprints' . DS . 'year.yml');
  $kirby->set('blueprint', 'sermon',          __DIR__ . DS . 'blueprints' . DS . 'sermon.yml');
  $kirby->set('blueprint', 'search',          __DIR__ . DS . 'blueprints' . DS . 'search.yml');

  // Templates
  $kirby->set('template',  'library',         __DIR__ . DS . 'templates' . DS . 'library.php');
  $kirby->set('template',  'library.rss',         __DIR__ . DS . 'templates' . DS . 'library.rss.php');
  $kirby->set('template',  'series',          __DIR__ . DS . 'templates' . DS . 'series.php');
  //$kirby->set('template',  'series',          __DIR__ . DS . 'templates' . DS . 'series.rss.php');
  $kirby->set('template',  'sermon',          __DIR__ . DS . 'templates' . DS . 'sermon.php');
  $kirby->set('template',  'search',          __DIR__ . DS . 'templates' . DS . 'search.php');

  // Snippets
  $kirby->set('snippet',   'series-sidebar',  __DIR__ . DS . 'snippets' . DS . 'series-sidebar.php');
  $kirby->set('snippet',   'search-sidebar',  __DIR__ . DS . 'snippets' . DS . 'search-sidebar.php');
  $kirby->set('snippet',   'sermon',          __DIR__ . DS . 'snippets' . DS . 'sermon.php');
  $kirby->set('snippet',   'sermons-row',     __DIR__ . DS . 'snippets' . DS . 'sermons-row.php');

  // Controllers
  $kirby->set('controller', 'sermon',         __DIR__ . DS . 'controllers' . DS . 'sermon.php');
  $kirby->set('controller', 'series',         __DIR__ . DS . 'controllers' . DS . 'series.php');
  $kirby->set('controller', 'search',         __DIR__ . DS . 'controllers' . DS . 'search.php');

  // Models
  $kirby->set('page::model', 'sermon', 'SLK\\SermonPage');

  // Language Entries
  $code = site()->multilang() ? site()->language()->code() : c::get('slk.language', 'en');

  if(is_file(__DIR__ . DS . 'languages' . DS . $code . '.php')) {
    require_once(__DIR__ . DS . 'languages' . DS . $code . '.php');
  } else {
    require_once(__DIR__ . DS . 'languages' . DS . 'en.php');
  }

  // Pages Methods
  $kirby->set('pages::method', 'podcast', function($pages, $params = array()) {
    // Set Defaults for Podcast options
		$defaults = array(
			'url' 						 => url(),
			'title'					   => 'Podcast',
			'subtitle'  			 => null,
			'description' 		 =>	null,
			'author'					 => null,
			'image'					   =>	null,
			'category'				 => null,
			'subcategory' 		 =>	null,
			'explicit'				 => 'Clean',
			'language'				 => 'en-us',
			'copyright'			   =>	'Copyright',
			'lastBuildDate'    => date(DateTime::RFC822),
			'owner_name'			 => null,
			'owner_email' 		 => null,
			'generator'			   => c::get('slk.generator', 'Sermon Library for Kirby'),
			'docs'						 => 'http://www.apple.com/itunes/podcasts/specs.htm',
			'datefield'			   => 'date',
			'header'					 => true
		);

		// Merge user supplied options with defaults
		$options = array_merge($defaults, $params);

		// Sort items by date
		$items = $pages->sortBy($options['datefield'], 'desc');

		// Add the items
		$options['items'] = $items;

		// Set the pubDate
		$options['pubDate'] = $items->first()->date(DateTime::RFC822, $options['datefield']);

		// Send the XML header
		if($options['header']) header::type('text/xml');

		$rss = '<?xml version="1.0" encoding="UTF-8"?>';

		// Build Podcast RSS Feed
		$rss .= tpl::load(__DIR__ . DS . 'template' . DS . 'podcast.php', $options);

		return $rss;
  });

  // Hooks
  $kirby->set('hook', 'panel.file.upload', function($file) {
    if($file->type() == 'audio') {
      // Rename Audio File
      if($file->name() != $file->page()->uid()) {
        try {
          $filename = "{$file->page()->uid()}.{$file->extension()}";
          $file->rename($filename);
        } catch(Exception $e) {
          echo 'The file has not been renamed.';
          echo $e->getMessage();
        }
      }

      // Convert File
      $cloudconvert = new Api(c::get('slk.cloudconvert.apikey'));

      $cloudconvert->convert([
        'inputformat'   => $file->extension(),
        'outputformat'      => 'mp3',
        'input'             => 'download',
        'file'              => $file->url(),
        'converteroptions'  => [
          'audio_channels'  => 1,
          'audio_qscale'    => 7
        ],
        'callback'          => url(c::get('slk.cloudconvert.callbackuri')),
        'tag'               => $file->page()->uri()
      ]);
    }
  });

  // Routes
  $kirby->set('route', array(
    'pattern'     => c::get('slk.cloudconvert.callbackuri'),
    'action'      => function() {
      $cloudconvert = new Api(c::get('slk.cloudconvert.apikey'));

      $process = new Process($cloudconvert, get('url'));
      $process->refresh();

      $sermon = site()->page($process->tag);
      $path = kirby()->roots()->content() . DS . $sermon->diruri() . DS . $process->output->filename;

      if($process->step == 'finished') {
        $process->download($path);
        // Add Code to Make Page Visible.
      } else {
        throw new Exception('Conversion Error: ' . $process->message);
      }

      response::success();
    }
  ));
