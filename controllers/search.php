<?php
  return function($site, $pages, $page) {
    $query = get('q');
    $page  = param('page');

    if($query) {
      $results    = algolia()->search($query, $page);
      $pagination = $results->pagination();
    } else {
      $results    = array();
      $pagination = null;
    }

    return compact('results', 'pagination');
  };
