<?php
  return function($site, $pages, $page) {
    $sermons = $page->grandChildren()->visible()->filterBy('template', 'sermon')->filterBy('hasAudio', '>', '0')->flip()->limit(25);

    return compact('sermons');
  };
