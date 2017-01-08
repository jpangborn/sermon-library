<?php
  return function($site, $pages, $page) {
    $series = page(kirby()->get('option', 'slk.main.uri'))->grandChildren()->visible()->filterBy('template', 'sermon')->filterBy('series', $page->uri())->paginate(9);
    $pagination = $series->pagination();

    return compact('series', 'pagination');
  };
