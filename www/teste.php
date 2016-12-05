<?php
header ("Content-type: image/png");
$im = @imagecreatetruecolor(1024, 768)
      or die("Cannot Initialize new GD image stream");
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 50, 50, 50,  "Leonardo é o BOM!", $text_color);
imagepng($im);
imagedestroy($im);
?>