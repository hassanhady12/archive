<?php
include_once '../lib/Session.php';
Session::checkSeeion();
?>
<?php include_once './inc/hader.php'; ?>



<div class="container">
    <div class="col-md-4 offset-md-4">
        <div class="singup-form">
            <form method="post" id='input_form' class="mt-5  border p-4 bg-light shadow">
                <h3 class="col-md-8">أضافه شركه</h3>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <h5 class="float-end">أسم شركه </h5>
                        <input type="text" id="catName" class="form-control float-end" name="catName">
                        <input id="submit" class="mt-3 col-12 float-end btn btn-primary" name="submit" type="submit" value="أضافه شركه">
                    </div>
                </div>
            </form>

            <div class="mt-4" id='result'></div>
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
                url: 'ajaxcatinsert.php',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#result').html(response);
                    setTimeout(function() { // wait for 5 secs(2)
                        location.reload(); // then reload the page.(3)
                    }, 1000);
                },
                complete: function() {
                    $(this).data('requestRunning', false);
                }
            })
        });
    });
</script>
<?php include_once './inc/footer.php'; ?>