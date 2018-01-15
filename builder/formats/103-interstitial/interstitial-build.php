<?php


//------------------------------------------------------------------------------
// COLLAPSED FILE
$data["zipfile"]["ext"] = f::strtoken(strtolower($_FILES["zipfile"]["name"]),-1,".");
$data["zipfile"]["file"] = $dir . "/index" .$data["zipfile"]["ext"];
if(!move_uploaded_file($_FILES["zipfile"]["tmp_name"], $data["zipfile"]["file"] )) {
	$errors[] = "No uploaded file";
}

$selectedWidth = f::strtoken(f::getparam("size"),1,"x");
$selectedHeight = f::strtoken(f::getparam("size"),2,"x");

// only for zip or direct html

if($data["zipfile"]["ext"] == "zip") {
	$zip = new ZipArchive;
	if ($zip->open($data["zipfile"]["file"]) === TRUE) {
	    $zip->extractTo($dir);
	    $zip->close();
	    unlink($data["zipfile"]["file"]);
	} else {
	    $errors[] = "Could not unzip uploaded file";
	}
	if(!file_exists($dir . "/index.html")) {
		$errors[] = "No index.html in uploaded file";
	} else {
		$indexHTML = replaceHTML(file_get_contents($dir . "/index.html"), $folder);
		if(!$indexHTML) {
			$errors[] = "No <head> or </body> tags";
		}
	}

	// add content to index.html
} else if($data["zipfile"]["ext"] == "html") { 

	$indexHTML = replaceHTML(file_get_contents($data["zipfile"]["file"]), $folder);
	if(!$indexHTML) {
		$errors[] = "No <head> or </body> tags";
	}

} else if($data["zipfile"]["ext"] == "gif" 
	   or $data["zipfile"]["ext"] == "png"
	   or $data["zipfile"]["ext"] == "jpg") {
	$indexHTML = file_get_contents(__DIR__ . "/index.html");
	$vars = array();
	$vars["imageURL"] = f::strtoken($data["zipfile"]["file"],-1,"/");

	$imageSize = getimagesize($data["zipfile"]["file"]);


	if($selectedWidth=="fullscreen") {
		$errors[] = "Images cannot be fullscreen. Create an HTML or change the size.";	
	} else if ($selectedWidth != $imageSize[0] 
			or $selectedHeight != $imageSize[1]){
		$errors[] = "Uploaded image size is not ". f::getparam("size") .".";	
	} else {

	}
} else {
	//$errors[] = "Incorrect image format";
}

//------------------------------------------------------------------------------
$clicktagURL = f::getParam("clicktag_url");
if(strtolower(substr($clicktagURL,0,4))!="http") {
	$clicktagURL = "http://" . $clicktagURL;
}
$vars["clicktagURL"] = $clicktagURL;
//------------------------------------------------------------------------------
if(f::getparam("clicktag_layer")) {
	$vars["clicktagLayer"] = "<div style = 'position: fixed; width: 100%; height: 100%; top: 0px; overflow: hidden; "
		."z-index: 98;display: block; cursor:pointer' onclick=\"console.log(clickTag);window.open(clickTag, '_blank')\" ></div>";	
} else {
	$vars["clicktagLayer"] = "";
}
//------------------------------------------------------------------------------
$vars["autoclose"] = f::getparam("autoclose") * 1;
$vars["close_button"] = f::getparam("close_button");
$vars["close_button_width"] = f::getparam("close_button_width");
$vars["close_button_height"] = f::getparam("close_button_height");
$vars["bgcolor"] = f::getparam("bgcolor");

if(f::getparam("size")=="fullscreen") {
  $vars["width"] = 3840;
  $vars["height"] = 2160;
} else {
  $vars["width"] = f::strtoken(f::getparam("size"),1,"x") * 1;
  $vars["height"] = f::strtoken(f::getparam("size"),2,"x") * 1;
}

if(!$errors) {
	$indexHTML = replaceAll($vars, $indexHTML);
	file_put_contents($dir . "/index.html", $indexHTML);
//	zipFolder($folder);
//	$adURL = "https://adcase.io/files/$folder/index.html";
//	$adId = $folder;
} 

function replaceHTML($indexHTML, $folder) {

  $replaceBODY = '  [[clicktagLayer]]
<script>
  var clickTag = "[[clicktagURL]]";
  console.log("adcase creative '.$folder.'");
  
  window.top.postMessage( {
    msg: "adcase", format:"interstitial",
    params:{  
    backgroundColor: "[[bgcolor]]",
    autoclose: [[autoclose]],
    close_button: "[[close_button]]",
    close_button_width: "[[close_button_width]]",
    close_button_height: "[[close_button_height]]",
    width:[[width]],
    height:[[height]]
     }
   }
     , "*");

window.addEventListener("message", _rm_Message, false);
function _rm_Message(e) { 
  if(e.data && e.data.width && e.data.height) {
    document.body.style.width = e.data.width;
    document.body.style.height = e.data.height;
  }
}
</script>
<script data-exports-type="dclk-quick-preview">if(typeof studio !== "undefined" && studio.Enabler) { studio.Enabler.setRushSimulatedLocalEvents(true); }
</script>
</body>';
  $replaceHEAD = '<head><meta name="ad.size" content="width=[[width]],height=[[height]]">';
  if(strpos($indexHTML, "</body>") === false) {
  	$indexHTML = false;
  } else if(strpos($indexHTML, "<head>") === false) {
	$indexHTML = false;
  } else {
  	
  	$indexHTML = str_replace("<meta name=\"ad.size\"", "<meta name=\"old.adsize\"", $indexHTML);
  	$indexHTML = str_replace("</body>", $replaceBODY, $indexHTML);
  	$indexHTML = str_replace("<head>", $replaceHEAD, $indexHTML);
  }

  return $indexHTML;

}