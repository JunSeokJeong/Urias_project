<?php
$options = getopt("i:", array('book_name::', 'path::', 'book_img_name::'));
$i = $options["i"];
$path = $options["path"];
$book_img_name = $options["book_img_name"];
$book_name = $options["book_name"];
$dir = '/volunteer_img/'.$book_name.'/'.$book_name.'_pri_img/';

system('node ./js/visionAPI.js '. ($i + 1) .' '.$path.$book_img_name.' '.$book_name);
$img_text = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.($i + 1).'.json')); 
$page_text = $img_text->responses[0]->textAnnotations[0]->description;

$connection = mysqli_connect("localhost", "root", "", "c9") or die("error");

mysqli_query($connection, "set names utf8");

$result = mysqli_query($connection ,
       "INSERT INTO ".$book_name."_pages (p_img_dir, p_pri_text, page_num) VALUE ('".$dir.$book_img_name."', '".$page_text."', ".($i + 1).");");

mysqli_close($connection);
?>