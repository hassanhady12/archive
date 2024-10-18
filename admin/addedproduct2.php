<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<?php include_once '../classes/Category.php'; ?>


<?php $pro = new Product(); ?>

<?php
if (!isset($_GET['edit']) || $_GET['edit'] == null) {
    echo '<script>window.location="selectproduct2.php";</script>';
} else {
    $id = $_GET['edit'];
} ?>

<div class="container">


    <div class="col-md-4 offset-md-4">
        <div class="singup-form">
            <form method="post" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8">راجع المنتج</h3>
                <div class="row">
                    <div id='result'></div>

                    <div class="mb-3 col-md-12">
                        <?php
                        $show = $pro->getproductById2($id);
                        if ($show) {
                            while ($result = $show->fetch_assoc()) {
                        ?>

                                <input id="id" type="hidden" name="id" value="<?php echo $id ?>">


                                <h5 class="float-end">اسم منتج </h5>
                                <input type="text" class="form-control float-end" name="ProductName1" value="<?php echo $result['ProductName1'] ?>" disabled>

                                <?php if (empty($result['ProductName1']) || empty($result['ProductNumber1'])) { ?>
                                    <input id="ProductNumber1" type="hidden" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1  form-control float-end" name="ProductNumber1" placeholder="العدد" value="0">

                                <?php  } else { ?>
                                    <h5 class="float-end mt-5">عدد المنتج </h5>
                                    <button class="btn btn-primary  col-12"><?php echo $result['ProductNumber1'] ?></button>
                                    <input id="ProductNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="form-control mt-3 float-end" name="ProductNumber1" placeholder="العدد">
                                <?php } ?>

                                <h5 class="float-end">صوره</h5>
                                <img class="form-control" src="<?php echo $result['image'] ?>">


                                <div class="mb-3 col-md-12">
                                    <h5 class="float-end" for="">أختر شركه</h5>
                                    <select class="form-control float-end" name="catId" disabled>
                                        <option>ألأقسام</option>
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

                        <input class="mt-3 col-12  float-end btn btn-primary" name="submit" type="submit" value="أضافه وحفظ">
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
            if ($(this).data('requestRunning')) {
                return;
            }
            $(this).data('requestRunning', true);

            $.ajax({
                url: 'ajaxaddedproduct2.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#result').html(response);
                    setTimeout(function() { // wait for 5 secs(2)
                        window.location = 'selectproduct2.php' // then reload the page.(3)
                    }, 1000);

                },
                complete: function() {
                    $(this).data('requestRunning', false);
                }
            });
        });
    });
</script>
<?php include_once './inc/footer.php'; ?>