<?php

session_start();

/*
if (isset($_SESSION['user_id'])) {
    header('Location: /menu.php');
}
*/

/*if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    header('Location: /admin.php');
} elseif (isset($_SESSION['user_id']) && $_SESSION['role'] === "user") {
    header('Location: /menu.php');
}*/

require_once 'database.php';

if (isset($_POST['registr'])) {
    $ism = $_POST['ismi'];
    $password = $_POST['password'];
    $seriya = $_POST['seriya'];
    $tel_raqam = $_POST['tel_raqam'];

    $ism = mysqli_real_escape_string($connect, $ism);
    $password = mysqli_real_escape_string($connect, $password);
    $seriya = mysqli_real_escape_string($connect, $seriya);
    $tel_raqam = mysqli_real_escape_string($connect, $tel_raqam);

    $query = "INSERT INTO mehmonlar (ismi,tel_raqam,passport,parol) VALUES('{$ism}', '{$tel_raqam}', '{$seriya}','{$password}')";

    $result = mysqli_query($connect, $query) or die("So'rov ishlamadi : " . mysqli_error($connect));

    $query = "SELECT * FROM mehmonlar WHERE passport='{$seriya}' AND parol='{$password}'";

    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $result['id'];
        $_SESSION['ismi'] = $result['ismi'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['tel_raqam'] = $result['tel_raqam'];
        $_SESSION['seriya'] = $result['passport'];
        $_SESSION['password'] = $result['parol'];

        header('refresh:1;url=/menu.php');
    } else {
        $error = 1;
    }
    mysqli_close($connect);

    header('refresh:1;url=/menu.php');

    exit;
} elseif (isset($_POST['kirish'])) {
    $seriya = $_POST['seriya'];
    $password = $_POST['password'];
    $seriya = mysqli_real_escape_string($connect, $seriya);
    $password = mysqli_real_escape_string($connect, $password);

    $query = "SELECT * FROM mehmonlar WHERE passport='{$seriya}' AND parol='{$password}'";

    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $result['id'];
        $_SESSION['ismi'] = $result['ismi'];
        $_SESSION['role'] = $result['role'];
        $_SESSION['tel_raqam'] = $result['tel_raqam'];
        $_SESSION['seriya'] = $result['passport'];
        $_SESSION['password'] = $result['parol'];

        if ($_SESSION['role'] === "admin") {
            header('refresh:1;url=/operator.php');
        } else {
            header('refresh:1;url=/menu.php');
        }
    } else {
        $error = 1;
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">


    <!-- Bootstrap core CSS -->
    <link href="/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        #main {
            width: 250px;
            margin: 0 auto;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        body {
            background-image: lightgrey;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <main class="form-signin ">
                    <form method="post">

                        <h3>Registratsiya</h3>
                        <div class="form-floating  m-3">
                            <input type="text" name="ismi" class="form-control" id="floatingInput" placeholder="Ism">
                            <label for="floatingInput">Ism</label>
                        </div>
                        <div class="form-floating m-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">password</label>
                        </div>
                        <div class="form-floating  m-3">
                            <input type="text" class="form-control" name="seriya" id="floatingInput" placeholder="seriya raqami">
                            <label for="floatingInput">possport</label>
                        </div>
                        <div class="form-floating  m-3">
                            <input type="text" class="form-control" name="tel_raqam" id="floatingInput" placeholder="Tel raqam">
                            <label for="floatingInput">Telefon </label>
                        </div>


                        <button class="w-100 btn btn-lg btn-primary" name="registr" type="submit">OK</button>

                    </form>
                </main>
            </div>
            <div class="col-6">
                <main class="form-signin mt-10">
                    <form method="post">

                        <h3>Krish</h3>
                        <div class="form-floating  m-3">
                            <input type="text" name="seriya" class="form-control" id="floatingInput" placeholder="seriya">
                            <label for="floatingInput">possport</label>
                        </div>
                        <div class="form-floating m-3">
                            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">password</label>
                        </div>


                        <button class="w-100 btn btn-lg btn-primary" name="kirish" type="submit">OK</button>

                    </form>
                </main>
            </div>
        </div>
    </div>
    <script src="/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>