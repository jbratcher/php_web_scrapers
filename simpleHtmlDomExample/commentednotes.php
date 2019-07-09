<?php

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

// image thumbnail
// img[alt="Post image"]

// $imgs = "";

// foreach($html->find('img[alt*=Post]') as $element) {
//     $imgsrc = $element->src;
//     $wrappedimg = '<img src="'.$imgsrc.'" />';
//     echo $wrappedimg;
//     $imgs .= $wrappedimg;
// }

// to append content instead of replace

// if(file_exists($savePath.$fileName)) {
//     $oldContent = file_get_contents($savePath.$fileName);
// }

?>