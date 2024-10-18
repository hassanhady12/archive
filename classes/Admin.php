<?php

include_once '../lib/Database.php';


//class Adminlogin

class AdminLogin
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    public function adminInsert($admin)
    {

        $adminUser = mysqli_real_escape_string($this->db->link, $admin['adminUser']);
        $adminPass = mysqli_real_escape_string($this->db->link, $admin['adminPass']);
        $adminPass = md5($adminPass);
        $level = mysqli_real_escape_string($this->db->link, $admin['level']);


        if (empty($admin)) {
            $admin = "يجب ادخال بينات";
            $msg = $admin;
            return $msg;
        } else {
            $query  = "INSERT INTO tbl_admin(adminUser,adminPass,level) VALUES ('$adminUser','$adminPass','$level')";
            $catinsert =  $this->db->insert($query);
            if ($catinsert) {
                $admin = "تمت اضافه المستخدم";
                $msg = $admin;
                return $msg;
            } else {
                $admin = "لم تتم الاضافه المستخدم";
                $msg = $admin;
                return $msg;
            }
        }
    }

    public function getAlladmin()
    {
        $query  = 'SELECT * FROM tbl_admin ORDER BY adminId  DESC';
        $result = $this->db->select($query);
        return $result;
    }



    public function getadminById($id)
    {
        $query  = "SELECT * FROM tbl_admin WHERE adminId = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function adminUpdate($data, $id)
    {
        $adminUser = mysqli_real_escape_string($this->db->link, $data['adminUser']);
        $adminPass = mysqli_real_escape_string($this->db->link, $data['adminPass']);
        $adminPass = md5($adminPass);
        $level = mysqli_real_escape_string($this->db->link, $data['level']);

        if (isset($adminUser)) {

            $query = "UPDATE tbl_admin 
                      SET  
                           adminUser = '$adminUser',
                           adminPass= '$adminPass',
                           level= '$level'
                      WHERE adminId = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $catName = "تمت تعديل المستخدم";
                $msg = $catName;
                return $msg; // return This Message
            } else {
                $msg = "Not Updated . ";
                return $msg; // return This Message
            }
        }
    }



    public function delPorById($id)
    {

        $delquery = "DELETE FROM tbl_admin WHERE adminId = '$id' ";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = " Deleted Successfully";
            return $msg;
        } else {
            $msg = "Not Deleted ";
            return $msg;
        }
    }
}
