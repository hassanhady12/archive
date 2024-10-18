<?php include_once '../classes/Product.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $id = $_POST['id'];
    $catId = $_POST['catId'];
    $img_name = $_FILES['image']['name'];;
    $errorEmpty = false;


    if (empty($id) || empty($catId)) {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $pro = new Product();
        $updatproduct = $pro->productUpdate($_POST, $_FILES, $id);
        echo $updatproduct;
    }
}

?>

<script>
    $('#catId').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#catId').addClass("input_error");
    }
</script>