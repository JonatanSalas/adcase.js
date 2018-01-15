<?php

$indexHTML = file_get_contents(__DIR__ . "/index.html");
//------------------------------------------------------------------------------
// COLLAPSED FILE
$data["videofile"]["ext"] = f::strtoken(strtolower($_FILES["videofile"]["name"]),-1,".");
$data["videofile"]["file"] = $dir . "/video.mp4";
if($data["videofile"]["ext"] != "mp4") {
  $errors[] = "Uploaded file must be mp4";
} else if(!move_uploaded_file($_FILES["videofile"]["tmp_name"], $data["videofile"]["file"] )) {
	$errors[] = "No uploaded video file";
} else {
	$vars["videofile"] = "video.mp4";
}

$vars["backgroundImage"] = "";
if(isset($_FILES["background_image"])) {
	$ext = f::strtoken(strtolower($_FILES["background_image"]["name"]),-1,".");
	$data["background_image"]["file"] = $dir . "/bg." .$ext;
	if($ext!="jpg" && $ext!="png" && ext!="gif") {
		$errors[] = "Background image must be jpg, png or gif.";
	} else if(!move_uploaded_file($_FILES["background_image"]["tmp_name"], $data["background_image"]["file"] )) {
		$errors[] = "No background image";
	} else {
		$vars["backgroundImage"] = "bg." .$ext;
	}
}

$selectedWidth = f::strtoken(f::getparam("size"),1,"x");
$selectedHeight = f::strtoken(f::getparam("size"),2,"x");

// only for zip or direct html


//------------------------------------------------------------------------------
$clicktagURL = f::getParam("clicktag_url");
if(strtolower(substr($clicktagURL,0,4))!="http") {
	$clicktagURL = "http://" . $clicktagURL;
}
$vars["clicktagURL"] = $clicktagURL;
//------------------------------------------------------------------------------
if(f::getparam("size")=="fullscreen") {
  $vars["width"] = 9999;
  $vars["height"] = 9999;
} else {
  $vars["width"] = f::strtoken(f::getparam("size"),1,"x") * 1;
  $vars["height"] = f::strtoken(f::getparam("size"),2,"x") * 1;
}
$vars["backgroundColor"] = f::getParam("background_color");


if(!$errors) {
	$indexHTML = replaceAll($vars, $indexHTML);
	file_put_contents($dir . "/index.html", $indexHTML);
//	zipFolder($folder);
//	$adURL = "https://adcase.io/files/$folder/index.html";
//	$adId = $folder;
} 
