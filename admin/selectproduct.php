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

    $delete = $sel->delPorById($id);
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
                    <th> التفاصيل</th>
                    <th>العدد</th>
                    <th>أسم الشركه</th>
                    <th>تعديل او حذف</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $show = $sel->getAllProduct();
                $i = 0;
                if ($show) {
                    while ($result = $show->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>

                            <th>

                                <picture>
                                    <source srcset="<?php echo $result['image']; ?>" media="(min-width: 100px)">
                                    <source srcset="<?php echo $result['image']; ?>" media="(min-width: 100px)">
                                    <source srcset="<?php echo $result['image']; ?>" media="(min-width: 0px)">
                                    <img src="<?php echo $result['image']; ?>" height="100" width="100" class="img-responsive" loading="eager" alt="Blah">
                                </picture>
                            </th>

                            <th>

                                <?php if (empty($result['ProductNumber1']) || empty($result['ProductName1'])) { ?>
                                <?php } else { ?>
                                    <span cl><?php echo $result['ProductName1']; ?></span>
                                    <br>
                                <?php } ?>

                                <?php if (empty($result['ProductNumber2']) || empty($result['ProductName2'])) { ?>
                                <?php } else { ?>
                                    <span><?php echo $result['ProductName2']; ?></span>
                                    <br>
                                <?php } ?>

                                <?php if (empty($result['DecorNumber1']) || empty($result['Decor1'])) { ?>
                                <?php } else { ?>
                                    <span><?php echo $result['Decor1']; ?></span>
                                    <br>
                                <?php } ?>


                                <?php if (empty($result['DecorNumber1']) || empty($result['Decor2'])) { ?>
                                <?php } else { ?>
                                    <span><?php echo $result['Decor2']; ?></span>
                                    <br>
                                <?php } ?>

                            </th>

                            <th>
                                <?php if (empty($result['ProductNumber1']) || empty($result['ProductName1'])) { ?>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><?php echo $result['ProductNumber1']; ?></span><br>
                                <?php } ?>

                                <?php if (empty($result['ProductNumber2']) || empty($result['ProductName2'])) { ?>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><?php echo $result['ProductNumber2']; ?></span><br>
                                <?php } ?>

                                <?php if (empty($result['DecorNumber1']) || empty($result['Decor1'])) { ?>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><?php echo $result['DecorNumber1']; ?></span><br>
                                <?php } ?>


                                <?php if (empty($result['DecorNumber1']) || empty($result['Decor2'])) { ?>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><?php echo $result['DecorNumber2']; ?></span><br>
                                <?php } ?>

                            </th>

                            <th><?php echo $result['Name_cat']; ?></th>

                            <th>
                                <?php
                                if (Session::get('level') == 0 || Session::get('level') == 1) {
                                    echo '<a class="btn btn-primary" href="editproduct.php?edit=' . $result['Id_product'] . '">تعديل</a>';
                                }
                                ?>
                                <a class="btn btn-primary" href="subproduct.php?edit=<?php echo $result['Id_product']; ?>">تنزيل</a>
                                <a class="btn btn-primary" href="addedproduct.php?edit=<?php echo $result['Id_product']; ?>">راجع</a>

                                <?php
                                if (Session::get('level') == 0 || Session::get('level') == 1) {
                                    echo '<a class="btn btn-danger" id="del" href="selectproduct.php?del=' . $result['Id_product'] . '">مسح</a>';
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
                    <th>العدد</th>
                    <th>أسم الشركه</th>
                    <th>تعديل او حذف</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>

<script type="text/javascript">

    window.addEventListener("load", function() {
        const script = document.createElement("script");
        script.src = "./js/custom.js";

        document.body.appendChild(script);
    });
</script>

<?php include_once './inc/footer.php'; ?>