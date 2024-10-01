<?php
function loadHelper()
{
    // get all files in this directory
    $files = array_diff(scandir(__DIR__), array('.', '..'));

    // load all files except current file
    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') {
            continue;
        }
        if (pathinfo($file, PATHINFO_FILENAME) === pathinfo(__FILE__, PATHINFO_FILENAME)) {
            continue;
        }
        require_once __DIR__ . '/' . $file;
    }
}

loadHelper();