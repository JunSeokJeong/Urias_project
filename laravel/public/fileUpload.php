<?php

system('touch ttt.mp3');
$result = array();
$result_data = "failed";

header('Access-Control-Allow-Origin: *');

$name = $_FILES["file"]["name"];
$file_name = substr($name, 0, -4);
$file_extention = substr($name, -4);

if($file_extention == ".amr") {
    $file_path = "blindcare/question/question_file/";
}
else if($file_extention == ".mp3") {
    $file_path = "blindcare/question/question_file/";
}
else if($file_extention == ".jpg") {
    $file_path = "blindcare/question/capture_file/";
}
else if($file_extention == ".mp4") {
    $file_path = "blindcare/question/capture_file/";
}

move_uploaded_file($_FILES["file"]["tmp_name"], $file_path.$name);


if($file_extention == ".amr") {
    system('ffmpeg -i '.$file_path.$file_name.'.amr -ar 22050 '.$file_path.$file_name.'.mp3');
    // system('ffmpeg -i amr/'.$target.' -ar 22050 amr/audio1.mp3');
}

$result_data = "success";

$result = [
    'result' => $result_data,
    'upload_file_name' => $name,
    'file_name' => $file_name,
    'file_extention' => $file_extention
];

echo json_encode($result);
?>
