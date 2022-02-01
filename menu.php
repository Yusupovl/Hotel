<?php
session_start();
require_once 'database.php';


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Pstyle.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <!-- Navbar start-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand m-auto " style="text-align:center;font-size:28px;font-family:'Times New Roman', Times, serif" href="#">Hotel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <?php if (isset($_SESSION['id'])) : ?>
                <a class="nav-link btn btn-outline-primary text-success" aria-current="page" href="#"><?= $_SESSION['ismi'] ?><br></a>
                <a href="/chiqish.php" class="btn mx-2 btn-primary btn">Chiqish</a>
            <?php else : ?>
                <a href="/login.php" class="btn mx-2 btn-primary btn">Kirish</a>

            <?php endif ?>

        </nav>
        <!-- Navbar end-->

        <!-- <ul class="list-group">
            <li class="list-group-item"><a href="/chiqish.php" class="btn  btn-primary text-white btn">Chiqish</a></li>
            <li class="list-group-item">
                <!-- Order list menu 
                
                <!-- Button trigger modal 
            </li> -->
        </ul>

        <div class="container">

            <div class="row">

                <?php
                $query = "SELECT * from xona_malumotlari";
                $result = mysqli_query($connect, $query) or die("So'rov ishlamadi : " . mysqli_error($connect));

                while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                ?>
                    <div class="card col-4 my-2">
                        <h5 class=" mt-2 card-title col-4"><?= $line['turi'] ?></h5>
                        <img src="<?= $line['rasm'] ?>" class="card-img mt-1 img-fluid">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title col-4 "><?= $line['xona_nomeri']  ?> - xona</h5>
                            </div>


                            <?php if (isset($_SESSION['ismi']) && isset($_SESSION['seriya'])) {   ?>
                                <a href="/asosiy.php?id=<?= $line['id'] ?>" class="btn btn-primary text-white" style="text-decoration:none; color:black;">Qo'shish</a>
                            <?php } else { ?>
                                <a href="/login.php?id=<?= $line['id'] ?>" class="btn btn-primary text-white" style="text-decoration:none; color:black;">Qo'shish</a>
                            <?php } ?>


                        </div>
                    </div>

                    <!-- PHP cod oxiri -->
                <?php
                }
                ?>



            </div>

        </div>

    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>