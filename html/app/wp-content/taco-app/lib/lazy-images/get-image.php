<?php

// this file needs FrontendLoader - see composer.json
// TODO: Put the code below into a class and refactor

require_once __DIR__.'/../vendor/autoload.php';

$image_file_path = (array_key_exists('image_file_path', $_GET))
  ? $_GET['image_file_path'] : null;

if(is_null($image_file_path)) {
  throw new Exception('You must include a file path.', 1);
  exit;
}
$quality_to_get = (array_key_exists('lazy_quality', $_GET))
  ? $_GET['lazy_quality']
  : 'existing_file';

$full_path =  $_SERVER['DOCUMENT_ROOT'].'/'.$image_file_path;
if(!file_exists($full_path)) {
  throw new Exception('The file specified does not exist.');
  exit;
}

if($quality_to_get === 'existing_file') {
  $content_type = \FrontendLoader\FrontendLoader::getContentType($full_path);
  header('Content-type: '.$content_type);
  header('Content-Length: '.filesize($full_path));
  http_response_code(200);
  readfile($full_path);
  exit;
}

$qualities_jpeg = array(
  'low' => 20,
  'medium' => 50,
  'high' => 90
);
$qualities_png = array(
  'low' => 9,
  'medium' => 5,
  'high' => 2
);

$file_name = basename($full_path);
$extension = pathinfo($file_name, PATHINFO_EXTENSION);
$file_name_no_extension = preg_replace("/\.$extension/", '', $file_name);
$file_path_to_get = __DIR__.'/app/responsive-images/'.$file_name_no_extension.'-'.$quality_to_get.'.'.$extension;

if(!file_exists($file_path_to_get)) {

  if($extension == 'jpeg' || $extension == 'jpg') {
    $img = imagecreatefromjpeg($full_path);
    if($quality_to_get ===  'low') {
      for ($i = 0; $i < 10; $i++) {
        imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
      }
    }
    imagejpeg($img, $file_path_to_get, $qualities_jpeg[$quality_to_get]);
    imagedestroy($img);
  }
  if($extension == 'png') {
    $img = imagecreatefrompng($full_path);
    if($quality_to_get ===  'low') {
      for ($i = 0; $i < 10; $i++) {
        imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
      }
    }
    imagepng($img, $file_path_to_get, $qualities_png[$quality_to_get]);
    imagedestroy($img);
  }
  if($extension == 'gif') {
    $img = imagecreatefromgif($full_path);
    if($quality_to_get ===  'low') {
      for ($i = 0; $i < 10; $i++) {
        imagefilter($img, IMG_FILTER_GAUSSIAN_BLUR);
      }
    }
    imagegif($img, $file_path_to_get); // since you cannot lower a gifs quality, we should use some other effect
    imagedestroy($img);
  }
  $content_type = \FrontendLoader\FrontendLoader::getContentType($file_path_to_get);
  header('Content-type: '.$content_type);
  header('Content-Length: '.filesize($file_path_to_get));
  http_response_code(200);
  readfile($file_path_to_get);
  exit;
}
$content_type = \FrontendLoader\FrontendLoader::getContentType($file_path_to_get);
header('Content-type: '.$content_type);
header('Content-Length: '.filesize($file_path_to_get));
http_response_code(200);
readfile($file_path_to_get);
exit;

  
