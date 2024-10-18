<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>

<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Category.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">



<?php $sel = new Category() ?>

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
                    <th>أسم شركه</th>
                    <th>تعديل او حذف</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $show = $sel->getAllcat();
                $i = 0;
                if ($show) {
                    while ($result = $show->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <th><?php echo $i; ?></th>
                            <th><?php echo $result['Name_cat']; ?></th>
                            <th>
                                <a class="btn btn-primary" href="editcat.php?edit=<?php echo $result['idCat']; ?>">تعديل</a>
                                <a class="btn btn-danger" href="selectcat.php?del=<?php echo $result['idCat'] ?>">مسح</a>

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
                    <th>أسم شركه</th>
                    <th>تعديل او حذف</th>

                </tr>
            </tfoot>
        </table>

    </div>
</div>

<script>
    window.addEventListener("load", function() {
        const script = document.createElement("script");
        script.src = "./js/custom.js";

        document.body.appendChild(script);
    });
</script>
<?php include_once './inc/footer.php'; ?>