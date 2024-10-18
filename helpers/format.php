<?php

class Format
{

    public function textShorten($text, $limt = 400)
    {
        $text = $text . "";
        $text = substr($text, 0, $limt);
        $text =  $text . "...";
        return $text;
    }

    public function validation($data)
    {

        $data = trim($data);
        $data = stripcslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }
}
