<?php
include_once '../lib/Database.php';
?>

<?php
class Product
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function productInsert($proName, $file)
    {

        $ProductName1 = mysqli_real_escape_string($this->db->link, $proName['ProductName1']);
        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);

        $ProductName2 = mysqli_real_escape_string($this->db->link, $proName['ProductName2']);
        $ProductNumber2 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber2']);

        $Decor1 = mysqli_real_escape_string($this->db->link, $proName['Decor1']);
        $DecorNumber1 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber1']);


        $Decor2 = mysqli_real_escape_string($this->db->link, $proName['Decor2']);
        $DecorNumber2 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber2']);

        $catId = mysqli_real_escape_string($this->db->link, $proName['catId']);



        if (empty($proName)) {
            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {

            $query  = "INSERT INTO product(ProductName1,ProductNumber1,ProductName2,ProductNumber2,Decor1,DecorNumber1,Decor2,DecorNumber2,image,catId)
                            VALUES ('$ProductName1','$ProductNumber1','$ProductName2','$ProductNumber2','$Decor1','$DecorNumber1','$Decor2','$DecorNumber2','$file','$catId')";
            $proinsert =  $this->db->insert($query);
            if ($proinsert) {
                $proName = '<div class="alert alert-success">تمت الاضافه</div>';
                $msg = $proName;
                return $msg;
            } else {
                $proName = "لم تتم الاضافه المنتج";
                $msg = $proName;
                return $msg;
            }
        }
    }

    public function productInsert2($proName, $file)
    {


        $ProductName1 = mysqli_real_escape_string($this->db->link, $proName['ProductName1']);
        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);
        $catId = mysqli_real_escape_string($this->db->link, $proName['catId']);



        if (empty($proName)) {
            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {

            $query  = "INSERT INTO product2(ProductName1,ProductNumber1,image,catId)
                            VALUES ('$ProductName1','$ProductNumber1','$file','$catId')";
            $proinsert =  $this->db->insert($query);
            if ($proinsert) {
                $proName = '<div class="alert alert-success">تمت الاضافه</div>';
                $msg = $proName;
                return $msg;
            } else {
                $proName = "لم تتم الاضافه المنتج";
                $msg = $proName;
                return $msg;
            }
        }
    }



    public function getAllProduct()
    {
        $query  = 'SELECT product.*, cat.Name_cat
                   FROM product
                   INNER JOIN cat
                   ON product.catId = cat.idCat 
                   ORDER BY product.Id_product DESC';
        $result = $this->db->select($query);
        return $result;
    }


    public function getAllProduct2()
    {
        $query  = 'SELECT product2.*, cat.Name_cat
                   FROM product2
                   INNER JOIN cat
                   ON product2.catId = cat.idCat 
                   ORDER BY product2.pro DESC';
        $result = $this->db->select($query);
        return $result;
    }

    public function getproductById($id)
    {
        $query  = "SELECT * FROM product WHERE Id_product = '$id'";
        $result = $this->db->select($query);
        return $result;
    }


    public function getproductById2($id)
    {
        $query  = "SELECT * FROM product2 WHERE pro = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

    public function productUpdate($proName, $file, $id)
    {

        $ProductName1 = mysqli_real_escape_string($this->db->link, $proName['ProductName1']);
        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);

        $ProductName2 = mysqli_real_escape_string($this->db->link, $proName['ProductName2']);
        $ProductNumber2 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber2']);

        $Decor1 = mysqli_real_escape_string($this->db->link, $proName['Decor1']);
        $DecorNumber1 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber1']);


        $Decor2 = mysqli_real_escape_string($this->db->link, $proName['Decor2']);
        $DecorNumber2 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber2']);

        $catId = mysqli_real_escape_string($this->db->link, $proName['catId']);




        $img_name = $file['image']['name'];
        $img_size = $file['image']['size'];
        $tmp_name = $file['image']['tmp_name'];
        $error    = $file['image']['error'];

        if (!empty($img_name)) {

            $query = "SELECT * FROM product WHERE Id_product  = '$id' ";
            $getData = $this->db->select($query);
            if ($getData) {
                while ($delImg = $getData->fetch_assoc()) {
                    $dellink = $delImg['image'];
                    unlink($dellink);
                }
            }


            if ($error === 0) {

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_ex = array("jpeg", "jpg", "png");

                if ($img_size > 111111110000 && in_array($img_ex_lc, $allowed_ex) == false) {
                    $em = 'large img or type';
                    $error = array('error' => 1, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;

                $img_Uplode_path = "upload/product/" . $new_img_name;

                move_uploaded_file($tmp_name, $img_Uplode_path);

                $query =
                    "UPDATE 
                    product 
                    SET  
                    ProductName1 = '$ProductName1',
                    ProductNumber1 = '$ProductNumber1',
                    ProductName2 = '$ProductName2',
                    ProductNumber2 = '$ProductNumber2',
                    Decor1 = '$Decor1',
                    DecorNumber1 = '$DecorNumber1',
                    Decor2 = '$Decor2',
                    DecorNumber2 = '$DecorNumber2',
                    catId = '$catId',
                    image = '$img_Uplode_path' 
                    WHERE Id_product  = '$id'";

                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $proName = '<div class="alert alert-success">تمت تعديل</div>';
                    $msg = $proName;
                    return $msg;
                } else {
                    $msg = " Not Updated";
                    return $msg;
                }
            } else {
                $em = 'error';
                $error = array('error' => 1, 'em' => $em);
                echo json_encode($error);
                exit();
            }
        } else {
            $query =
                "UPDATE 
                    product 
                    SET  
                    ProductName1 = '$ProductName1',
                    ProductNumber1 = '$ProductNumber1',
                    ProductName2 = '$ProductName2',
                    ProductNumber2 = '$ProductNumber2',
                    Decor1 = '$Decor1',
                    DecorNumber1 = '$DecorNumber1',
                    Decor2 = '$Decor2',
                    DecorNumber2 = '$DecorNumber2',
                    catId = '$catId'
                    WHERE Id_product  = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = " Not Updated";
                return $msg; // return This Message
            }
        }
    }



    public function productUpdate2($proName, $file, $id)
    {

        $ProductName1 = mysqli_real_escape_string($this->db->link, $proName['ProductName1']);
        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);


        $catId = mysqli_real_escape_string($this->db->link, $proName['catId']);




        $img_name = $file['image']['name'];
        $img_size = $file['image']['size'];
        $tmp_name = $file['image']['tmp_name'];
        $error    = $file['image']['error'];

        if (!empty($img_name)) {

            $query = "SELECT * FROM product2 WHERE pro  = '$id' ";
            $getData = $this->db->select($query);
            if ($getData) {
                while ($delImg = $getData->fetch_assoc()) {
                    $dellink = $delImg['image'];
                    unlink($dellink);
                }
            }


            if ($error === 0) {

                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_ex = array("jpeg", "jpg", "png");

                if ($img_size > 111111110000 && in_array($img_ex_lc, $allowed_ex) == false) {
                    $em = 'large img or type';
                    $error = array('error' => 1, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;

                $img_Uplode_path = "upload/product/" . $new_img_name;

                move_uploaded_file($tmp_name, $img_Uplode_path);

                $query =
                    "UPDATE 
                    product2 
                    SET  
                    ProductName1 = '$ProductName1',
                    ProductNumber1 = '$ProductNumber1',
                    catId = '$catId',
                    image = '$img_Uplode_path' 
                    WHERE pro  = '$id'";

                $updated_row = $this->db->update($query);
                if ($updated_row) {
                    $proName = '<div class="alert alert-success">تمت تعديل</div>';
                    $msg = $proName;
                    return $msg;
                } else {
                    $msg = " Not Updated";
                    return $msg;
                }
            } else {
                $em = 'error';
                $error = array('error' => 1, 'em' => $em);
                echo json_encode($error);
                exit();
            }
        } else {
            $query =
                "UPDATE 
                    product2 
                    SET  
                    ProductName1 = '$ProductName1',
                    ProductNumber1 = '$ProductNumber1',
                    catId = '$catId'
                    WHERE pro  = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = " Not Updated";
                return $msg; // return This Message
            }
        }
    }





    public function producSubtUpdate($proName, $id)
    {

        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);

        $ProductNumber2 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber2']);

        $DecorNumber1 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber1']);

        $DecorNumber2 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber2']);


        if (empty($proName)) {
            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {
            $query = "UPDATE product SET  
                    ProductNumber1 = IF((ProductNumber1 = '') OR (ProductNumber1 = 0),ProductNumber1,ProductNumber1-'$ProductNumber1'),
                    ProductNumber2 = IF((ProductNumber2 = '') OR (ProductNumber2 = 0),ProductNumber2,ProductNumber2-'$ProductNumber2'),
                    DecorNumber1   = IF((DecorNumber1  = '') OR (DecorNumber1 = 0), DecorNumber1,DecorNumber1-'$DecorNumber1'),
                    DecorNumber2   = IF((DecorNumber2  = '') OR (DecorNumber2 = 0), DecorNumber2,DecorNumber2-'$DecorNumber2')
                    WHERE Id_product  = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تنزيل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = "Not Updated ";
                return $msg; // return This Message
            }
        }
    }

    public function producSubtUpdate3($proName, $id)
    {

        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);

        $ProductNumber2 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber2']);

        $DecorNumber1 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber1']);

        $DecorNumber2 = mysqli_real_escape_string($this->db->link, $proName['DecorNumber2']);


        if (empty($proName)) {

            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {
            $query
                = "UPDATE product SET  
                    ProductNumber1 = IF((ProductNumber1 = '') OR (ProductNumber1 = 0),ProductNumber1,ProductNumber1+'$ProductNumber1'),
                    ProductNumber2 = IF((ProductNumber2 = '') OR (ProductNumber2 = 0),ProductNumber2,ProductNumber2+'$ProductNumber2'),
                    DecorNumber1   = IF((DecorNumber1  = '') OR (DecorNumber1 = 0), DecorNumber1,DecorNumber1+'$DecorNumber1'),
                    DecorNumber2   = IF((DecorNumber2  = '') OR (DecorNumber2 = 0), DecorNumber2,DecorNumber2+'$DecorNumber2')
                    WHERE Id_product  = '$id'";
            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = "Product Not Updated ";
                return $msg; // return This Message
            }
        }
    }


    public function producSubtUpdate2($proName, $id)
    {

        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);


        if (empty($proName)) {
            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {

            $query = "UPDATE product2 
                      SET                     
                       ProductNumber1 = IF((ProductNumber1 = '') OR (ProductNumber1 = 0),ProductNumber1,ProductNumber1-'$ProductNumber1')
                      WHERE pro  = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = "Product Not Updated ";
                return $msg; // return This Message
            }
        }
    }

    public function producSubtUpdate4($proName, $id)
    {

        $ProductNumber1 = mysqli_real_escape_string($this->db->link, $proName['ProductNumber1']);


        if (empty($proName)) {
            $proName = "يجب ادخال بينات";
            $msg = $proName;
            return $msg;
        } else {

            $query =
                "UPDATE product2 
                      SET                     
                       ProductNumber1 = IF((ProductNumber1 = '') OR (ProductNumber1 = 0),ProductNumber1,ProductNumber1+'$ProductNumber1')
                      WHERE pro  = '$id'";

            $updated_row = $this->db->update($query);
            if ($updated_row) {
                $proName = '<div class="alert alert-success">تمت تعديل</div>';
                $msg = $proName;
                return $msg; // return This Message
            } else {
                $msg = "Product Not Updated ";
                return $msg; // return This Message
            }
        }
    }


    public function delPorById($id)
    {
        $query = "SELECT * FROM product WHERE Id_product  = '$id' ";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink = $delImg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM product WHERE Id_product = '$id' ";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "Product Deleted Successfully.";
            return $msg;
        } else {
            $msg = "Product Not Deleted .";
            return $msg;
        }
    }

    public function delPorById2($id)
    {
        $query = "SELECT * FROM product2 WHERE pro  = '$id' ";
        $getData = $this->db->select($query);
        if ($getData) {
            while ($delImg = $getData->fetch_assoc()) {
                $dellink =  $delImg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM product2 WHERE pro = '$id' ";
        $deldata = $this->db->delete($delquery);
        if ($deldata) {
            $msg = "Product Deleted Successfully. ";
            return $msg;
        } else {
            $msg = "Product Not Deleted  ";
            return $msg;
        }
    }

    public function countStudent()
    {
        $query  = "SELECT * FROM product";
        $result = $this->db->count($query);
        return $result;
    }

    public function countStudent2()
    {
        $query  = "SELECT * FROM product2";
        $result = $this->db->count($query);
        return $result;
    }
}
?>