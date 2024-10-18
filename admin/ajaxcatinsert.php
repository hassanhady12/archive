<?php include_once '../classes/Category.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    $errorEmpty = false;

    if (empty($catName)) {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $cat = new Category();
        $result = $cat->catInsert($_POST);
        echo $result;
    }
}
?>

<script>
    $('#catName').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#catName').addClass("input_error");
    }

    if (errorEmpty == false) {
        $('#catName').val("");
    }
</script>