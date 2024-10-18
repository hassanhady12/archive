<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<?php include_once '../classes/Category.php'; ?>


<?php $pro = new Product(); ?>

<?php
if (!isset($_GET['edit']) && $_GET['edit'] == null) {
    echo '<script>window.location="selectproduct2.php";</script>';
} else {
    $id = $_GET['edit'];
} ?>

<div class="container">


    <div class="col-md-4 offset-md-4">
        <div class="singup-form">
            <div id="result"></div>
            <form method="post" enctype="multipart/form-data" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8">تعديل منتج</h3>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <?php
                        $show = $pro->getproductById2($id);
                        if ($show) {
                            while ($result = $show->fetch_assoc()) {
                        ?>

                                <input id="id" type="hidden" name="id" value="<?php echo $id; ?>">


                                <h5 class="float-end">اسم المنتج </h5>
                                <input id="ProductName1" type="text" class="form-control float-end" name="ProductName1" value="<?php echo $result['ProductName1'] ?>">

                                <h5 class="float-end">عدد المنتج </h5>
                                <input id="ProductNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="form-control float-end" name="ProductNumber1" value="<?php echo $result['ProductNumber1'] ?>">

                                <h5 class="float-end">صوره</h5>
                                <input id="image" type="file" class="form-control float-end" name="image">
                                <img class="form-control" src="<?php echo $result['image'] ?>">


                                <div class="mb-3 col-md-12">
                                    <h5 class="float-end" for="">أختر قسم</h5>
                                    <select id="catId" class="form-control float-end" name="catId">
                                        <option disabled>ألأقسام</option>
                                        <?php
                                        $cat = new Category();
                                        $getCat = $cat->getAllCat();
                                        if ($getCat) {
                                            while ($value = $getCat->fetch_assoc()) { ?>
                                                <option <?php
                                                        if ($value['idCat'] == $result['catId']) { ?> selected="selected" <?php  } ?> value="<?php echo $value['idCat']; ?>">
                                                    <?php echo $value['Name_cat']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                        <?php }
                        } ?>

                        <input class="mt-3 col-12 float-end btn btn-primary" name="submit" type="submit" value="تعديل منتج">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $("form").submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: 'ajaxproduct2update.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#result').html(response);
                    setTimeout(function() { // wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 5000);
                }
            });
        });
    });
</script>
<?php include_once './inc/footer.php'; ?>