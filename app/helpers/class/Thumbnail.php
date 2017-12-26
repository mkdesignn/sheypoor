<?php

class Thumbnail
{

    /**
     * Make the thumbnail
     *
     * @param $thumbnail
     * @return string
     */
    public static function make($thumbnail){

        $post_thumbnail = explode(".", $thumbnail);
        $extension = $post_thumbnail[count($post_thumbnail)-1];
        $file_name = explode("/", $post_thumbnail[count($post_thumbnail)-2]);

//        $ph_add = dirname(dirname(public_path())). '/public_html/uploads/' . $file_name[count($file_name) - 1];
        $ph_add = public_path() . '/uploads/' . $file_name[count($file_name) - 1];

        // make series of thumbnails
        self::saveThumbnails($ph_add . "." . $extension, $ph_add . "_thumbnail." . $extension);

        // return the thumbnail name
        return $file_name[count($file_name)-1]."_thumbnail.".$extension;
    }

    /**
     * @param $image_address
     * @param $save_image
     */
    private static function saveThumbnails($image_address, $save_image){

        $save_image = explode(".", $save_image);
        $filename = $image_address;

        // Get new dimensions
        list($source_width, $source_height) = getimagesize($filename);
        $counter = 0;

        //      - 768px by 1024px (http://goo.gl/nY45z)
        if( $source_width > 768 && $source_height > 1024 ){
            $counter ++;
            $large_thumbnail_percent = 0.8;
            $large_thumbnail_width = $source_width * $large_thumbnail_percent;
            $large_thumbnail_height = $source_height * $large_thumbnail_percent;
            createImage($large_thumbnail_width, $large_thumbnail_height,
                $filename, $save_image[0]."_large.".$save_image[1] , $source_width, $source_height);

        }

        //      - 375px by 500px (http://goo.gl/nY45z)
        if( $source_width > 375 && $source_height > 500 ){
            $counter++;
            $big_thumbnail_percent = 0.6;
            $big_thumbnail_width = $source_width * $big_thumbnail_percent;
            $big_thumbnail_height = $source_height * $big_thumbnail_percent;
            createImage($big_thumbnail_width, $big_thumbnail_height,
                $filename, $save_image[0]."_big.".$save_image[1] , $source_width, $source_height);
        }


        //      - 180px by 240px (http://goo.gl/nY45z)
        if( $source_width > 180 && $source_height > 240 ){
            $counter++;
            $small_thumbnail_percent = 0.4;
            $small_thumbnail_width = $source_width * $small_thumbnail_percent;
            $small_thumbnail_height = $source_height * $small_thumbnail_percent;
            createImage($small_thumbnail_width, $small_thumbnail_height,
                $filename, $save_image[0]."_small.".$save_image[1] , $source_width, $source_height);
        }

        //      - 75px by 100px (http://goo.gl/F03do)
        if( $source_width > 180 && $source_height > 100 ){
            $counter++;
            $extra_small_thumbnail = 0.2;
            $extra_small_thumbnail_width = $source_width * $extra_small_thumbnail;
            $extra_small_thumbnail_height = $source_height * $extra_small_thumbnail;
            createImage($extra_small_thumbnail_width, $extra_small_thumbnail_height,
                $filename, $save_image[0]."_extra_small.".$save_image[1] , $source_width, $source_height);
        }

        // create small thumbnail if no one of the above conditions work
        if( $counter == 1 ){
            $small_thumbnail_percent = 0.4;
            $small_thumbnail_width = $source_width * $small_thumbnail_percent;
            $small_thumbnail_height = $source_height * $small_thumbnail_percent;
            createImage($small_thumbnail_width, $small_thumbnail_height,
                $filename, $save_image[0]."_small.".$save_image[1] , $source_width, $source_height);
        }
    }
}