<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>

<?php include_once './inc/hader.php'; ?>
<?php include_once '../classes/Category.php'; ?>






<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="singup-form">



            <form id="input_form" method="post" enctype="multipart/form-data" class="mt-5 border p-4 bg-light shadow">
                <h3 class="col-md-8 mb-3">أضافه جدران</h3>
                <div class="row">

                    <div class="mb-3 col-md-12">

                        <div class='p-2 mb-3 btn border border-info  border-3'>
                            <input id="ProductName1" type="text" class="form-control float-end" name="ProductName1" placeholder="اسم طوخ">
                            <input id="ProductNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-2 form-control float-end" name="ProductNumber1" placeholder="العدد">
                        </div>

                        <div class='p-2 mb-3 btn border border-info  border-3'>
                            <input id="ProductName2" type="text" class="form-control float-end" name="ProductName2" placeholder="اسم فاتح">
                            <input id="ProductNumber2" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-2 form-control col-4 float-end" name="ProductNumber2" placeholder="العدد">
                        </div>

                        <div class='p-2 mb-3 btn border border-info  border-3'>
                            <input id="Decor1" type="text" class="form-control float-end" name="Decor1" placeholder="ديكور A">
                            <input id="DecorNumber1" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-2 form-control float-end" name="DecorNumber1" placeholder="العدد">
                        </div>

                        <div class='p-2 mb-3 btn border border-info  border-3'>
                            <input id="Decor2" type="text" class="form-control float-end" name="Decor2" placeholder="ديكور B">
                            <input id="DecorNumber2" type="text" inputmode="decimal" pattern="[0-9]*[.,]?[0-9]*" class="mt-2 form-control float-end" name="DecorNumber2" placeholder="العدد">
                        </div>

                        <div id='result'></div>

                        <h5 class="float-end">صوره</h5>
                        <input id="image" type="file" class="form-control float-end" name="image">

                        <div class="mb-3 col-md-12">
                            <h5 class="float-end">أختر قسم</h5>
                            <select id="catId" class="form-control float-end" name="catId">
                                <option value="0">ألأقسام</option>
                                <?php
                                $cat = new Category();
                                $getCat = $cat->getAllCat();
                                if ($getCat) {
                                    while ($result = $getCat->fetch_assoc()) { ?>
                                        <option value="<?php echo $result['idCat']; ?>"><?php echo $result['Name_cat']; ?>
                                        </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <?php
                        if (Session::get('level') == 0 || Session::get('level') == 1) {
                            echo '<input  id="submit" class="mt-3 col-12  float-end btn btn-primary" name="submit" type="submit" value="أضافه وحفظ">';
                        }
                        ?>

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
                url: 'ajaxinserproduct.php',
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
                },
                complete: function() {
                    $(this).data('requestRunning', false);
                }
            })
        });
    });
</script>




<?php include_once './inc/footer.php'; ?>