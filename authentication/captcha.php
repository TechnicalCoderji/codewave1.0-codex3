<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$captcha_text = '';
$characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjklmnpqrstuvwxyz';
for ($i = 0; $i < 5; $i++) {
    $captcha_text .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_code'] = $captcha_text;

$width = 220;
$height = 60;
$image = imagecreatetruecolor($width, $height);

// Colors
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);
$line_color = imagecolorallocate($image, 100, 100, 100);
$dot_color = imagecolorallocate($image, 150, 150, 150);
imagefill($image, 0, 0, $bg_color);

// Draw random lines
for ($i = 0; $i < 10; $i++) {
    imageline($image, rand(0,$width), rand(0,$height), rand(0,$width), rand(0,$height), $line_color);
}

// Add dots
for ($i = 0; $i < 1000; $i++) {
    imagesetpixel($image, rand(0,$width), rand(0,$height), $dot_color);
}

// Fonts array (add more if you have them)
$fonts = [
    __DIR__ . '/arial.ttf'
];

// Check fonts exist
foreach ($fonts as $font) {
    if (!file_exists($font)) {
        die("Font file not found: " . basename($font));
    }
}

// Draw each character separately
for ($i = 0; $i < strlen($captcha_text); $i++) {
    $angle = rand(-25, 25);
    $x = 20 + ($i * 30) + rand(-3, 3);
    $y = rand(35, 50);
    $font_size = rand(20, 28);
    $font = $fonts[array_rand($fonts)];
    imagettftext($image, $font_size, $angle, $x, $y, $text_color, $font, $captcha_text[$i]);
}

header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
