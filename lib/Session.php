<?php

class Session
{

    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {

        if (isset($_SESSION[$key])) {

            return $_SESSION[$key];
        } else {

            return false;
        }
    }

    public static function checkSeeion()
    {

        self::init();
        if (self::get('adminlogin') == false) {

            self::destroy();
            header("Location:login.php");
            exit();
        }
    }

    public static function checkLogin()
    {

        self::init();
        if (self::get("adminlogin") == true) {

            header("Location:index.php");
            exit();
        }
    }

    public static function destroy()
    {
        session_start();
        session_unset();
        session_destroy();
        header("location:login.php");
        exit();
    }
}
