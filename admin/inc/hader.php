<?php include_once '../function/function.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php getTitle();  ?></title>

    <link rel="shortcut icon" href="../admin/img/1626048716_alsamah.png" type="image/x-icon" />

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;500&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: "Cairo", sans-serif;
        }

        .navbar {
            background-color: #25cde3;
        }

        div.dataTables_wrapper {
            width: 800px;
            margin: 0 auto;
        }

        input {
            text-align: right;
        }

        .input_error {
            box-shadow: 0 0 5px red;
        }
    </style>



</head>

<body>
    <nav class="navbar navbar-expand-lg mb-5">
        <div class="container">
            <a class="navbar-brand" href="index.php"> <?php echo Session::get('adminUser'); ?> مرحبا بك </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <?php
                        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                            Session::destroy();
                        }
                        ?>
                        <a class="nav-link active btn btn-danger" aria-current="page" href="?action=logout">تسجيل
                            خروج</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            الشركات
                        </a>
                        <?php
                        if (Session::get('level') == 0) {
                            echo '<ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addcat.php">أضافه شركه</a></li>
                            <li><a class="dropdown-item" href="selectcat.php">عرض الشركه</a></li>
                        </ul>';
                        }
                        ?>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            المستخدمين وصلاحيات
                        </a>
                        <?php
                        if (Session::get('level') == 0) {
                            echo '<ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="adminadd.php">أضافه مستخدم</a></li>
                            <li><a class="dropdown-item" href="selectadmin.php">عرض المستخدمين</a></li>
                        </ul>';
                        }
                        ?>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            الجدران
                        </a>
                        <?php
                        if (Session::get('level') == 0 || Session::get('level') == 1 || Session::get('level') == 2) {
                            echo '<ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addproduct.php">أضافه جدران</a></li>
                            <li><a class="dropdown-item" href="selectproduct.php">عرض جدران</a></li>
                        </ul>';
                        }
                        ?>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            باقي النوعيات
                        </a>
                        <?php
                        if (Session::get('level') == 0 || Session::get('level') == 1 || Session::get('level') == 2) {
                            echo '<ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="addproduct2.php">أضافه منتج</a></li>
                            <li><a class="dropdown-item" href="selectproduct2.php">عرض مننج</a></li>
                        </ul>';
                        }
                        ?>
                    </li>
                </ul>

            </div>
        </div>
    </nav>