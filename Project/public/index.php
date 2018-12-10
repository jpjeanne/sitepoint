<?php

$title = 'Internet Joke Database';

// can't do $output = include 'blah.php'; and expect it to
// assign the text to the var because it just evals to true, so
// instead you have to turn on output buffering to prevent the
// include from sending the text to the browser 

ob_start();
include  __DIR__ . '/../templates/home.html.php';
$output = ob_get_clean();

include  __DIR__ . '/../templates/layout.html.php';
