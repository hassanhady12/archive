<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>

<?php include './inc/hader.php';  ?>

<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php'; ?>



<?php
$pageTitle = 'الصفحه الرئسيه';
$pro = new Product();
$cat = new Category();

?>



<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="singup-form">

            <form method="post" class="mt-5 border p-4 bg-light shadow">
                <div class="row">
                    <img src="../admin/img/1626048716_alsamah.png">

                    <div class="mb-3 col-md-12">

                        <div class='p-5 mb-3 btn border border-info col-12 border-3'>

                            <button type="button" onclick="location.href='selectproduct.php'" class="col-12 btn btn-primary">
                                اضغط هنا للبحث في الجدران

                            </button>
                        </div>

                        <div class='p-5 mb-3 btn border border-info col-12 border-3'>

                            <button type="button" onclick="location.href='selectproduct2.php'" class="col-12 btn btn-primary">
                                اضغط هنا للبحث باقي نوعيات

                            </button>
                        </div>


                        <div class='p-5 mb-3 btn border border-info col-12 border-3'>

                            <button type="button" class="col-12 btn btn-primary position-relative">
                                اعداد جدران
                                <span class="fs-5 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo  $pro->countStudent(); ?> <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>


                        </div>

                        <div class='p-5 mb-3 btn border border-info col-12 border-3'>

                            <button type="button" class="col-12 btn btn-primary position-relative">
                                اعداد باقي النوعيات
                                <span class="fs-5 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $pro->countStudent2(); ?> <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </div>


                        <div class='p-5 mb-3 btn border border-info col-12 border-3'>

                            <button type="button" class="col-12 btn btn-primary position-relative">
                                اعداد شركات
                                <span class="fs-5 position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $cat->countcat(); ?> <span class="visually-hidden">unread messages</span>
                                </span>
                            </button>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include './inc/footer.php';  ?>