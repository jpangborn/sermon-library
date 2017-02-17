<?php
  return function($site, $pages, $page) {
    $page->grandChildren()->visible()->filterBy('template', 'sermon')->flip()->limit(25);

    return compact('sermons');
  };
