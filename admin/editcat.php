<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Category.php'; ?>


<?php $cat = new Category(); ?>

<?php
if (!isset($_GET['edit']) || $_GET['edit'] == null) {
    echo '<script>window.location="selectcat.php";</script>';
} else {
    $id = $_GET['edit'];
} ?>






<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="singup-form">
            <form method="post" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8">تعديل شركه</h3>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <input id="id" type="hidden" name="id" value="<?php echo $id; ?>">
                        <?php
                        $show = $cat->getcatById($id);
                        if ($show) {
                            while ($result = $show->fetch_assoc()) {
                        ?>
                                <h5 class="float-end">أسم شركه </h5>
                                <input id="catName" type="text" class="form-control float-end" value="<?php echo $result['Name_cat'] ?>" name="catName">
                        <?php }
                        } ?>
                        <input id="submit" class="mt-3 col-12 float-end btn btn-primary" name="submit" type="submit" value="تعديل شركه">
                    </div>
                </div>
            </form>
            <div class="mt-4" id='result2'></div>

            <div class="mt-4" id='result'></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            var catName = $("#catName").val();
            var id = $("#id").val();
            var submit = $("#submit").val();

            $("#result").load("ajaxcatupdate.php", {
                catName: catName,
                id: id,
                submit: submit
            });
            $.ajax({
                url: 'ajaxcatupdate.php',
                type: 'POST',
                data: $("#input_form").serialize(),
                success: function(response) {
                    $('#result2').html(response);
                }
            })
        });
    });
</script>

<?php include_once './inc/footer.php'; ?>