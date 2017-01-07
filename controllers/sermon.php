<?php

  return function($site, $pages, $page) {
    $series = $site->pages()->findByURI($page->series());
    $teacher = $site->users()->find($page->teacher());

    return compact('series', 'teacher');
  };
