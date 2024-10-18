<?php include_once '../classes/Category.php'; ?>

<?php
if (isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $catName = $_POST['catName'];
    $id = $_POST['id'];
    $errorEmpty = false;

    if (empty($catName)) {
        echo '<div class="alert alert-danger">يجب ادخال بينات</div>';
        $errorEmpty = true;
    } else {
        $cat = new Category();
        $updatecat  = $cat->catUpdate($_POST, $id);
        echo $updatecat;
    }
}
?>

<script>
    $('#catName').removeClass("input_error");

    var errorEmpty = "<?php echo $errorEmpty ?>";

    if (errorEmpty == true) {
        $('#catName').addClass("input_error");
    }
</script>