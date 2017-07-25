<?php
//Allow Headers
header('Access-Control-Allow-Origin: *');
//print_r(json_encode($_FILES));
$new_image_name = urldecode($_FILES["file"]["name"]).".jpg";
//Move your files into upload folder
$name = $_FILES["file"]["name"].".jpg";
// $name = $_FILES["file"]["name"].".jpg";
move_uploaded_file($_FILES["file"]["tmp_name"], "blindcare/upload/".$name);
//  echo("<script>location.href='http://urias-heoyongjun.c9users.io/blindcare/obj2/".$name."';</script>"); 
$imageData = "./blindcare/upload/".$name;

system('node ./js/obj_visionAPI.js '.$imageData.' '.$name);
//됨
$img_text = json_decode(file_get_contents('./blindcare/obj_detection/'.$name.'.json'));
echo $img_text->responses[0]->textAnnotations[0]->description;


// $uploads_dir = 'image'; test ㄱㄱㄱㄱㄱㄱㄱㄱ
// foreach ($_FILES["pictures"]["error"] as $key => $error) {dz
//     if ($error == UPLOAD_ERR_OK) {
//         $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
//         // basename() may prevent filesystem traversal attacks;
//         // further validation/sanitation of the filename may be appropriate
//         $name = basename($_FILES["pictures"]["name"][$key]);
//         move_uploaded_file($tmp_name, "$uploads_dir/$name");
//     }
// }

    // //Allow Headers
    // header('Access-Control-Allow-Origin: *');
    // print_r(json_encode($_FILES));
    // //$new_image_name = urldecode($_FILES["file"]["name"]).".jpg";
    // $new_image_name = $_FILES["file"]["name"].".jpg";
    // //Move your files into upload folder
    // move_uploaded_file($_FILES["file"]["tmp_name"], "upload/".$new_image_name);
?>
