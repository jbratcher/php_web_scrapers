<?php

// https://simplehtmldom.sourceforge.io/ a simple yet powerful php library for web scraping
include('simple_html_dom.php');

$url = 'http://reddit.com';
$savePath = "saved/";

$fileName = 'redditfrontpage.html';
$oldContent = "";
$currentContent = "";

$html = file_get_html($url);

// get text content of main wrapper div of reddit.com
// foreach($html->find('div[class=rpBJOHq2PR60pnwJlUyP0]') as $element) {
//     $currentContent = '<p>'.$element->plaintext.'<p>';
// }

// get child text content of posts on main page of reddit
// foreach($html->find('div[class=rpBJOHq2PR60pnwJlUyP0]') as $element) {
//     $children = $element->children();
//     foreach($children as $child) {
//         $currentContent .= $child->innertext;
//     }
// }

// get title, img, and link for current front page
// post title
// div[style="--posttitletextcolor:#222222"] > h3.textContent
// foreach($html->find('a[href*=comments]') as $element) {
//     $children = $element->first_child();
//     foreach($children as $child) {
//         $posttitle = $child->textContent;
//         file_put_contents($savePath.$fileName, $posttitle);
//     }
// }

// $posttitles = "";

// foreach($html->find('a div h3') as $element) {
//     $posttitle = $element->plaintext;
//     echo $posttitle;
//     $wrappedtitle = '<h3>'.$posttitle.'</h3>';
//     $posttitles .= $wrappedtitle;
// }

// post link
// a href*="comments"

$elements = "";

foreach($html->find('a[data-click-id=body]') as $element) {
    echo $element;
    $titlewrapper = $element->first_child();
    $posttitle = $titlewrapper->first_child()->plaintext;
    $wrappedelement = '<a href=https://www.reddit.com'.$element->href.'<p>'.$posttitle.'</p></a>';
    $elements .= $wrappedelement;

}

// image thumbnail
// img[alt="Post image"]

// if(file_exists($savePath.$fileName)) {
//     $oldContent = file_get_contents($savePath.$fileName);
// }

// file_put_contents($savePath.$fileName, $posttitles);

file_put_contents($savePath.$fileName, $elements);

?>