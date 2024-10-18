<?php


include '../classes/AdminLogin.php';

$al = new AdminLogin();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adminUser = $_POST['adminUser'];
    $adminPass = $_POST['adminPass'];

    $loginChk  = $al->adminLogin($adminUser, $adminPass);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <div class="container">



        <div class="col-md-4 offset-md-4">
            <div class="singup-form">
                <form action="" method="post" class="mt-5 border p-4 bg-light shadow">
                    <h3 class="col-md-8">تسجيل دخول</h3>
                    <?php
                    if (isset($loginChk)) {
                        echo $loginChk;
                    }
                    ?>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <h5 class="float-end" for=""> أسم ألمستخدم</h5>
                            <input type="text" class="form-control float-end" name="adminUser">
                        </div>

                        <div class="mb-3 col-md-12">
                            <h5 class="float-end" for=""> ألرمز ألسري</h5>
                            <input type="password" class="form-control float-end" name="adminPass">
                            <input class=" mt-3 float-end btn btn-primary" type="submit" value="تسجيل">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>