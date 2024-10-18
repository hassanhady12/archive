<?php include_once '../classes/Product.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $errorEmpty = false;

    if (empty($id)) {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $pro = new Product();
        $updatproduct = $pro->producSubtUpdate($_POST, $id);
        echo $updatproduct;
    }
}

?>

<script>
    $('#id').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#id, #ProductNumber1, #ProductNumber2, #DecorNumber1, #DecorNumber2').addClass("input_error");
    }
</script>