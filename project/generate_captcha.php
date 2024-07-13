<?php
session_start();
header("Content-type: image/png");

$captcha_code = $_SESSION['captcha_code'];

$font = 5; // Font size
$width = imagefontwidth($font) * strlen($captcha_code);
$height = imagefontheight($font);

$image = imagecreate($width, $height);

$background = imagecolorallocate($image, 255, 255, 255); // white background
$foreground = imagecolorallocate($image, 0, 0, 0); // black text

imagestring($image, $font, 0, 0, $captcha_code, $foreground);

imagepng($image);
imagedestroy($image);
?>
