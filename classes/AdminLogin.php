<?php
include_once '../lib/Session.php';
Session::checkLogin();
include_once '../lib/Database.php';


//class Adminlogin

class AdminLogin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function adminLogin($adminUser, $adminPass)
    {


        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        $adminPass = md5($adminPass);

        if (empty($adminUser) || empty($adminPass)) {

            $loginmsg = "User name or password must not be empty";
            return $loginmsg;
        } else {

            $query  = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass' ";
            $result =  $this->db->select($query);

            if ($result != false) {
                $value = $result->fetch_assoc();
                Session::set("adminlogin", true);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("level", $value['level']);
                header("Location:index.php");
                exit();
            } else {

                $loginmsg = "الاسم او باسورد غير متطابق";
                return $loginmsg;
            }
        }
    }
}
