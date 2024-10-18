<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Admin.php'; ?>


<?php $sel = new AdminLogin() ?>

<?php

if (isset($_GET['del']) && !empty($_GET['del'])) {
    $id = $_GET['del'];

    $delete = $sel->delPorById($id);
}


?>

<div class="container">
    <div class="row">
        <?php
        if (isset($delete)) {
            echo $delete;
        }
        ?>

        <table id="example" class="table table-striped display nowrap table-bordered" style="width:100%">
            <thead>
                <tr>

                    <th>تسلسل</th>
                    <th>أسم مستخدم</th>
                    <th>صلاحيه</th>
                    <th>تعديل او حذف</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $show = $sel->getAlladmin();
                $i = 0;
                if ($show) {
                    while ($result = $show->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <th><?php echo $i; ?></th>
                            <th><?php echo $result['adminUser']; ?></th>
                            <th>
                                <?php
                                if ($result['level'] == 0) {
                                    echo 'مدير موقع';
                                } elseif ($result['level'] == 1) {
                                    echo 'مدير مخزن';
                                } else {
                                    echo 'مدير محل';
                                }
                                ?>
                            </th>

                            <th>
                                <a class="btn btn-primary" href="editadmin.php?edit=<?php echo $result['adminId']; ?>">تعديل</a>
                                <a class="btn btn-danger" href="selectadmin.php?del=<?php echo $result['adminId'] ?>">مسح</a>

                            </th>
                        </tr>

                <?php
                    }
                }
                ?>


            </tbody>
            <tfoot>
                <tr>
                    <th>تسلسل</th>
                    <th>أسم مستخدم</th>
                    <th>صلاحيه</th>
                    <th>تعديل او حذف</th>

                </tr>
            </tfoot>
        </table>

    </div>
</div>
<?php include_once './inc/footer.php'; ?>