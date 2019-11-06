<?php
// Overgenomen code van
// https://stackoverflow.com/questions/9862904/css-merging-with-php
//


// Array of extended javascript files
$javascriptExt = array(
    'licenses.js',
    'jquery.min.js',
    'app.js',
    'offline.min.js',
    // 'typeahead.bundle.min.js',
    // 'awesomplete.js',
    'persoonlijk.js'

);

// Array of minified javascript files
$javascriptMin = array(
    'licenses.js',
    'jquery.min.js',
    'app.js',
    'offline.min.js',
    // 'typeahead.bundle.min.js',
    // 'awesomplete.min.js',
    'persoonlijk.min.js'

);

$javascript = $javascriptExt;

// Prevent a notice
$javascript_content = '';

// Loop the javascript Array
foreach ($javascript as $javascript_file) {
    // Load the content of the javascript file
    $javascript_content .= file_get_contents($javascript_file);
}

// print the javascript content
echo $javascript_content;
?>
