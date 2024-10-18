<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Admin.php'; ?>

<?php $admin = new AdminLogin(); ?>

<?php
if (!isset($_GET['edit']) || $_GET['edit'] == null) {
    echo '<script>window.location="selectcat.php";</script>';
} else {
    $id = $_GET['edit'];
} ?>

<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $updateadmin  = $admin->adminUpdate($_POST, $id);
} ?>

<div class="container">

    <?php
    if (isset($updateadmin)) {
    ?>
        <script>
            Swal.fire({
                icon: 'info',
                title: 'تاكيد',
                text: '<?php echo $updateadmin ?>'
            }).then(function() {
                window.location = "selectadmin.php";
            });
        </script>
    <?php
    }
    ?>

    <div class="col-md-4 offset-md-4">
        <div class="singup-form">



            <form method="post" class="mt-5 border p-4 bg-light shadow">

                <h3 class="col-md-8">أضافه أقسام</h3>

                <div class="row">
                    <div class="mb-3 col-md-12">

                        <?php
                        $show = $admin->getadminById($id);
                        if ($show) {
                            while ($result = $show->fetch_assoc()) {
                        ?>
                                <h5 class="float-end">أسم المستخدم </h5>
                                <input type="text" class="form-control float-end" value="<?php echo $result['adminUser'] ?>" name="adminUser">

                                <div class="mb-5 col-md-12">
                                    <h5 class="float-end">باسورد</h5>
                                    <input type="password" class="form-control float-end" value="" name="adminPass">
                                </div>

                                <div class="mb-5 col-md-12">
                                    <h5 class="float-end" for="">أختر صلاحية</h5>
                                    <select class="form-control float-end" name="level">
                                        <option value="0">مدير موقع</option>
                                        <option value="1">مدير مخزن</option>
                                        <option value="2">مدير محل</option>
                                    </select>
                                </div>

                        <?php }
                        } ?>

                        <input class="mt-3 float-end btn btn-primary" name="submit" type="submit" value="أضافه قسم">
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php include_once './inc/footer.php'; ?>


