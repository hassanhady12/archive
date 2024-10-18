<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Product.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">



<?php $sel = new Product() ?>


<?php

if (isset($_GET['del']) && !empty($_GET['del'])) {
    $id = $_GET['del'];

    $delete = $sel->delPorById2($id);
}


?>

<?php
if (isset($delete)) {
    echo $delete;
}

?>

<div class="container">
    <div class="row">


        <table id="example" class="table table-striped display nowrap table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th> صوره الون</th>
                    <th> التفاصيل </th>
                    <th> العدد </th>


                    <th>أسم الشركه</th>


                    <th>تعديل او حذف</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $show = $sel->getAllProduct2();
                $i = 0;
                if ($show) {
                    while ($result = $show->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <th><img data-src="<?php echo $result['image']; ?>" alt="…" loading="lazy" class="lazyload" height="auto" width="100"></th>


                            <th>
                                <span><?php echo $result['ProductName1']; ?></span>
                            </th>

                            <th>
                                <span class="badge bg-success"><?php echo $result['ProductNumber1']; ?></span>
                            </th>

                            <th><?php echo $result['Name_cat']; ?></th>






                            <th>
                                <?php
                                if (Session::get('level') == 0 || Session::get('level') == 1) {
                                    echo '<a class="btn btn-primary" href="editproduct2.php?edit=' . $result['pro'] . '">تعديل</a>';
                                }
                                ?>
                                <a class="btn btn-primary" href="subproduct2.php?edit=<?php echo $result['pro']; ?>">تنزيل</a>
                                <a class="btn btn-primary" href="addedproduct2.php?edit=<?php echo $result['pro']; ?>">راجع</a>

                                <?php
                                if (Session::get('level') == 0 || Session::get('level') == 1) {
                                    echo '<a class="btn btn-danger" href="selectproduct2.php?del=' . $result["pro"] . '">مسح</a>';
                                }
                                ?>
                            </th>
                        </tr>

                <?php
                    }
                }
                ?>


            </tbody>
            <tfoot>
                <tr>
                    <th> صوره الون</th>
                    <th> التفاصيل</th>
                    <th> العدد </th>

                    <th>أسم الشركه</th>


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