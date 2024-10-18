<?php include_once '../classes/Product.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {

    $catId = $_POST['catId'];

    $img_name = $_FILES['image']['name'];
    $errorEmpty = false;


    if (empty($img_name) || empty($catId) || $catId == 0) {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $error    = $_FILES['image']['error'];


        if ($error === 0) {
            if ($img_size > 111111110000) {
                $em = 'large img';
                $error = array('error' => 1, 'em' => $em);
                echo json_encode($error);
                exit();
            } else {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);
                $allowed_ex = array("jpeg", "jpg", "png");

                if (in_array($img_ex_lc, $allowed_ex)) {
                    $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;

                    $img_Uplode_path = "upload/product/" . $new_img_name;

                    move_uploaded_file($tmp_name, $img_Uplode_path);
                    $pro = new Product();
                    $insertpro = $pro->productInsert2($_POST, $img_Uplode_path);
                    echo $insertpro;
                } else {
                    $em = 'type img';
                    $error = array('error' => 1, 'em' => $em);
                    echo json_encode($error);
                    exit();
                }
            }
        } else {
            $em = 'error';
            $error = array('error' => 1, 'em' => $em);
            echo json_encode($error);
            exit();
        }
    }
}



?>

<script>
    $('#image, #catId').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#image, #catId').addClass("input_error");
    }

    if (errorEmpty == false) {
        $('#ProductName1, #ProductNumber1, #image').val("");
    }
</script>