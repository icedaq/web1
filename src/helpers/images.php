<?php

if (isset($_GET['size']) && $_GET['path']) {
	if($_GET['size'] == "thumb") {
		header("Content-Type: image/png");
		echo imagepng(resize_image("../".$_GET['path'], 200, 150));
	}
	if($_GET['size'] == "medium") {
		header("Content-Type: image/png");
		echo imagepng(resize_image("../".$_GET['path'], 400, 300));
	}
}

function resize_image($file, $w, $h, $crop=FALSE) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($crop) {
        if ($width > $height) {
            $width = ceil($width-($width*abs($r-$w/$h)));
        } else {
            $height = ceil($height-($height*abs($r-$w/$h)));
        }
        $newwidth = $w;
        $newheight = $h;
    } else {
        if ($w/$h > $r) {
            $newwidth = $h*$r;
            $newheight = $h;
        } else {
            $newheight = $w/$r;
            $newwidth = $w;
        }
    }
    $src = imagecreatefrompng($file);
	$dst = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    return $dst;
}
