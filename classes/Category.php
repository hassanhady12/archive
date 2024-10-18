<?php

include_once '../lib/Database.php';

?>

<?php

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function catInsert($catName)
    {

        $catName = mysqli_real_escape_string($this->db->link, $catName['catName']);

        if (empty($catName)) {
            $catName = "يجب ادخال بينات";
            $msg = $catName;
            return $msg;
        } else {
            $query  = "INSERT INTO cat(Name_cat) VALUES ('$catName')";
            $catinsert =  $this->db->insert($query);
            if ($catinsert) {
                $catName = '<div class="alert alert-success">تمت الاضافه</div>';
                $msg = $catName;
                return $msg;
                exit();
            } else {
                $catName = "لم تتم الاضافه شركه";
                $msg = $catName;
                return $msg;
            }
        }
    }

    public function getAllcat()
    {
        $query  = 'SELECT * FROM cat ORDER BY idCat DESC';
        $result = $this->db->select($query);
        return $result;
    }

    public function getcatById($id)
    {
        $query  = "SELECT * FROM cat WHERE idCat = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function catUpdate($data, $id)
    {
        $catName     =  mysqli_real_escape_string($this->db->link, $data['catName']);

        if (isset($data)) {
            $query = "UPDATE cat SET  Name_cat = '$catName' WHERE idCat = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $catName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $catName;
                return $msg; // return This Message
            } else {
                $msg = "لم تتم عمليه التعديل";
                return $msg; // return This Message
            }
        }
    }

    public function delPorById($id)
    {
        $delquery = "DELETE FROM cat WHERE idCat = '$id' ";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "تم المسح";
            return $msg;
        } else {
            $msg = "لم تتم عمليه المسح";
            return $msg;
        }
    }

    public function countcat()
    {
        $query  = "SELECT * FROM cat";
        $result = $this->db->count($query);
        return $result;
    }
}
