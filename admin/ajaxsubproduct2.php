<?php include_once '../classes/Product.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $ProductNumber1 = $_POST['ProductNumber1'];

    $errorEmpty = false;

    if (empty($id) || $ProductNumber1 == '') {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $pro = new Product();
        $updatproduct = $pro->producSubtUpdate2($_POST, $id);
        echo $updatproduct;
    }
}

?>

<script>
    $('#id, #ProductNumber1').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#id, #ProductNumber1').addClass("input_error");
    }
</script>