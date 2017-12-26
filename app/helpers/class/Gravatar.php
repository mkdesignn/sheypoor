<?php

class Gravatar
{
    /**
     * Function to generate the Gravatar image tag.
     *
     * @param $email_address
     * @param string $style
     * @param null $firstname
     * @param null $surname
     * @param string $size
     * @return string
     */
    public static function image( $email_address ,$style = "", $firstname = null , $surname = null , $size = '50')
    {
        $hash = md5( strtolower( trim( $email_address ) ) );
        $url = 'http://www.gravatar.com/avatar/'.$hash.'?s=' . $size;
        if ( $firstname && $surname ){
            $alt_text = $firstname . ' ' . $surname;
        } else {
            $alt_text = 'Gravatar for ' . $email_address;
        }

        return '<img style="'.$style.'" class="avatar" src="'.$url.'" alt="'.$email_address.'"/>';
    }
}