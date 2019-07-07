<?php

include('simple_html_dom.php');

$url = 'http://reddit.com';
$savePath = "saved/";

$fileName = md5($url).'.html';
$oldContent = "";
$currentContent = "";

$html = file_get_html($url);

// get text content of main wrapper div of reddit.com
// foreach($html->find('div[class=rpBJOHq2PR60pnwJlUyP0]') as $element) {
//     $currentContent = '<p>'.$element->plaintext.'<p>';
// }

// get child text content of posts on main page of reddit
foreach($html->find('div[class=rpBJOHq2PR60pnwJlUyP0]') as $element) {
    $children = $element->children();
    foreach($children as $child) {
        $currentContent .= '<p>'.$child->plaintext.'<p>';
    }
}

if(file_exists($savePath.$fileName)) {
    $oldContent = file_get_contents($savePath.$fileName);
}

file_put_contents($savePath.$fileName,$currentContent);

?>