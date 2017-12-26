<?php
use Illuminate\Support\Facades\Session;
class Captcha
{
    private static $background = [00, 00, 00, 127];
    private static $line_color = [0xCC, 0xCC, 0xCC];
    private static $path;
    private static $total_number = 4;

    public static function create(){

        // initialise image with dimensions of 120 x 30 pixels
        $image = @imagecreatetruecolor(120, 35) or die("Cannot Initialize new GD image stream");

        // set background to white and allocate drawing colours
        if( self::$background[3] != 127 )
            $background = imagecolorallocatealpha($image, self::$background[0], self::$background[1], self::$background[2], self::$background[3]);
        else
            $background = imagecolorallocatealpha($image, 00, 00, 00, 127);

        imagefill($image, 0, 30, $background);

        $line_color = "";
        if( count( self::$line_color ) > 0 )
            $line_color = imagecolorallocate($image, self::$line_color[0], self::$line_color[1], self::$line_color[2]);


        // draw random lines on canvas
       if( count( self::$line_color ) > 0) {
            for($i=0; $i < 3; $i++) {
                imagesetthickness($image, rand(1,3));
                imageline($image, 0, rand(0,35), 120, rand(0,35), $line_color);
            }
       }


        // add random digits to canvas
        $font = self::getPath();

        $digit = '';
        $grey = imagecolorallocate($image, 128, 128, 128);
        $operation = array_rand(["+", "-", "/", "X"]);

        $divided_number = 100 / self::$total_number;
        for($x = $divided_number; $x <= 100; $x += $divided_number) {

            $digit .= ($num = rand(1, 9));
            $number = Convertnumber2farsi($num);
            $rotation = rand(-10, 10);
            imagettftext($image, 20, $rotation, $x - ( $divided_number / 2 ), 25, $grey, $font, $number);
        }

        // record digits in session variable
        Session::put("digit", $digit);

        ob_start(); // Let's start output buffering.
        imagesavealpha($image, TRUE);
        imagepng($image); //This will normally output the image, but because of ob_start(), it won't.
        $contents = ob_get_contents(); //Instead, output above is saved to $contents
        ob_end_clean(); //End the output buffer.
        $image = "data:image/jpeg;base64," . base64_encode($contents);

        return $image;
    }

    private static function getPath(){
        if( self::$path == null )
            return public_path().'/admin/fonts/IRANSans-web.ttf';
        else
            return self::$path;
    }

    public static function setConfig($background = [00, 00, 00, 127], $line_color = [] , $path = null){
        self::$background = $background;
        self::$line_color = $line_color;
        self::$path = $path;
        return new self;
    }
}