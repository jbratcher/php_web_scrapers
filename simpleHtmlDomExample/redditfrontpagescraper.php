<?php

// https://simplehtmldom.sourceforge.io/ a simple yet powerful php library for web scraping

include('simple_html_dom.php');

$url = 'http://reddit.com';
$savePath = "saved/";

$fileName = 'redditfrontpage.html';
$oldContent = "";
$currentContent = "";

$html = file_get_html($url);

// get post title and link and generate html elements

$elements = "";

foreach($html->find('a[data-click-id=body]') as $element) {
    $titlewrapper = $element->first_child();
    $posttitle = $titlewrapper->first_child()->plaintext;
    $wrappedelement = '<a href=https://www.reddit.com'.$element->href.'<p>'.$posttitle.'</p></a>';
    $elements .= $wrappedelement;
}

file_put_contents($savePath.$fileName, $elements);

?>