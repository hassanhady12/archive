<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Admin.php'; ?>

<?php
$admin = new AdminLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {


    $insertadmin = $admin->adminInsert($_POST, $_FILES);
}
?>

<?php
if (isset($insertadmin)) {
?>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'تاكيد',
            text: '<?php echo $insertadmin ?>'
        }).then(function() {
            window.location = "selectadmin.php";
        });
    </script>
<?php
}
?>


<div class="container">

    <div class="col-md-4 offset-md-4">
        <div class="singup-form">


            <form method="post" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8">أضافه مستخدم</h3>

                <div class="row">

                    <div class="mb-3 col-md-12">
                        <h5 class="float-end">أسم مستخدم </h5>
                        <input type="text" class="form-control float-end" name="adminUser">
                    </div>

                    <div class="mb-3 col-md-12">
                        <h5 class="float-end">باسورد</h5>
                        <input type="password" class="form-control float-end" name="adminPass">
                    </div>



                    <div class="mb-3 col-md-12">
                        <h5 class="float-end" for="">أختر صلاحية</h5>
                        <select class="form-control float-end" name="level">
                            <option value="0">مدير موقع</option>
                            <option value="1">مدير مخزن</option>
                            <option value="2">مدير محل</option>
                        </select>
                    </div>


                    <input class="mt-3 float-end btn btn-primary" name="submit" type="submit" value="أضافه مستخدم">
                </div>
            </form>

        </div>
    </div>
</div>

<?php include_once './inc/footer.php'; ?>