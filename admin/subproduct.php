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
    echo '<script>window.location="selectproduct.php";</script>';
} else {
    $id = $_GET['edit'];
} ?>




<div class="container">



    <div class="col-md-4 offset-md-4">
        <div class="singup-form">
            <form method="post" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8 text-danger  mb-3">تنزيل جدران</h3>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <?php
                        $show = $pro->getproductById($id);
                        if ($show) {
                            while ($result = $show->fetch_assoc()) {
                        ?>

                                <input id="id" type="hidden" name="id" value="<?php echo $id ?>">

                                <?php if (empty($result['ProductName1']) || empty($result['ProductNumber1'])) { ?>
                                    <input id="ProductNumber1" type="hidden" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1  form-control float-end" name="ProductNumber1" placeholder="العدد" value="0">

                                <?php  } else { ?>
                                    <div class='p-2 mb-3 btn border border-info  border-3'>
                                        <input id="ProductName1" type="text" class="form-control float-end" name="ProductName1" value="<?php echo $result['ProductName1'] ?>" disabled>
                                        <button class="btn btn-primary mt-3 col-12"><?php echo $result['ProductNumber1'] ?></button>
                                        <input id="ProductNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1  form-control float-end" name="ProductNumber1" placeholder="العدد">
                                    </div>
                                <?php } ?>

                                <?php if (empty($result['ProductName2']) || empty($result['ProductNumber2'])) { ?>
                                    <input id="ProductNumber2" type="hidden" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="ProductNumber2" placeholder="العدد" value="0">

                                <?php  } else { ?>
                                    <div class='p-2 mb-3 btn border border-info  border-3'>
                                        <input id="ProductName2" type="text" class="form-control float-end" name="ProductName2" value="<?php echo $result['ProductName2'] ?>" disabled>
                                        <button class="btn btn-primary mt-3 col-12"><?php echo $result['ProductNumber2'] ?></button>
                                        <input id="ProductNumber2" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="ProductNumber2" placeholder="العدد">
                                    </div>
                                <?php } ?>

                                <?php if (empty($result['Decor1']) || empty($result['DecorNumber1'])) { ?>
                                    <input id="DecorNumber1" type="hidden" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="DecorNumber1" placeholder="العدد" value="0">

                                <?php  } else { ?>
                                    <div class='p-2 mb-3 btn border border-info  border-3'>
                                        <input id="Decor1" type="text" class="form-control float-end" name="Decor1" value="<?php echo $result['Decor1'] ?>" disabled>
                                        <button class="btn btn-primary mt-3 col-12"><?php echo $result['DecorNumber1'] ?></button>
                                        <input id="DecorNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="DecorNumber1" placeholder="العدد">
                                    </div>
                                <?php } ?>

                                <?php if (empty($result['Decor2']) || empty($result['DecorNumber2'])) { ?>
                                    <input id="DecorNumber2" type="hidden" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="DecorNumber2" placeholder="العدد" value="0">

                                <?php  } else { ?>
                                    <div class='p-2 mb-3 btn border border-info  border-3'>
                                        <input id="Decor2" type="text" class="form-control float-end" name="Decor2" value="<?php echo $result['Decor2'] ?>" disabled>
                                        <button class="btn btn-primary mt-3 col-12"><?php echo $result['DecorNumber2'] ?></button>
                                        <input id="DecorNumber2" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-1 form-control float-end" name="DecorNumber2" placeholder="العدد">
                                    </div>
                                <?php } ?>

                                <div id='result'></div>

                                <h5 class="float-end">صوره</h5>
                                <img class="form-control" src="<?php echo $result['image'] ?>">


                                <div class="mb-3 col-md-12">
                                    <h5 class="float-end" for="">أختر قسم</h5>
                                    <select disabled class="form-control float-end" name="catId">
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

                        <input id="submit" class="mt-3 col-12  float-end btn btn-primary" name="submit" type="submit" value="تنزيل">
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
                url: 'ajaxsubproduct.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#result').html(response);
                    setTimeout(function() { // wait for 5 secs(2)
                        window.location = 'selectproduct.php'; // then reload the page.(3)
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