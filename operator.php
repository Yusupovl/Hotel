<?php

session_start();
require_once 'database.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Pstyle.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="container">

        <div class="change">
            <form class="row justify-content-center" method="POST">
                <div class="col-auto">
                    <input type="text" name="ism" class="form-control" placeholder="Search...">
                </div>
                <div class="col-auto mb-3">
                    <input type="submit" name="qidirish" class="form-control" value="Search">
                </div>
            </form>
        </div>



        <table class="table table-primary table-striped table-hover">
            <tr>
                <th colspan="8">Xona banligi jadvali</th>
            </tr>
            <tr>
                <th>id</th>
                <th>dan</th>
                <th>gacha</th>
                <th>xona_nomeri</th>
                <th>ism</th>
                <th>tel_raqam</th>
                <th>o'zgartirish</th>
                <th>o'chirish</th>
            </tr>
            <?php
            //qidirish amali
            $query = "SELECT * FROM xona_bandligi";
            if (isset($_POST['qidirish'])) {
                $username = $_POST['ism'];
                $query .= " WHERE ism LIKE '%{$username}%'";
                //$query .= " where ism LIKE '%" . $_POST['ism'] . "%'";
            }
            $result = mysqli_query($connect, $query) or die("So'rov ishlamadi : " . mysqli_error($connect));
            while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                print "<tr>";
                print "<td>{$line['id']}</td>";
                print "<td>{$line['dan']}</td>";
                print "<td>{$line['gacha']}</td>";
                print "<td>{$line['xona_nomeri']}</td>";
                print "<td>{$line['ism']}</td>";
                print "<td>{$line['tel_raqam']}</td>";
                print "<td><a href=\"/edit.php?id={$line['id']} \" ><i  class=\"far fa-edit\"></i></td>";
                print "<td><a href=\"/delete.php?id={$line['id']} \" ><i  class=\"far fa-trash-alt\"></i></td>";
            }
            ?>
        </table>

        <div class="change">
            <form class="row justify-content-center" method="POST">
                <div class="col-auto">
                    <select name="oy" id="">
                        <option value="1">yanvar</option>
                        <option value="2">fevral</option>
                        <option value="3">mart</option>
                        <option value="4">aprel</option>
                        <option value="5">may</option>
                        <option value="6">iyun</option>
                        <option value="7">iyul</option>
                        <option value="8">avgust</option>
                        <option value="9">sentyabr</option>
                        <option value="10">oktyabr</option>
                        <option value="11">noyabr</option>
                        <option value="12">dekabr</option>
                    </select>
                </div>
                <div class="col-auto">
                    <select name="yil" id="">
                        <?php for ($i = 2000; $i <= date("Y"); $i++) { ?>
                            <option value="<?= $i ?> "><?= $i ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-auto mb-3">
                    <input type="submit" name="qidirish_sana" class="form-control" value="Search">
                </div>
            </form>
        </div>




        <?php
        //qidirish amali
        $query = "SELECT * FROM xona_bandligi";
        if (isset($_POST['oy']) && isset($_POST['yil'])) {
            $oy = $_POST['oy'];
            $yil = $_POST['yil'];
            //$query .= " WHERE dan LIKE '%{$date}%' ";
            $query2 .= "SELECT count(*) AS soni FROM xona_bandligi WHERE MONTH(dan) <= {$oy} and MONTH(gacha) >= {$oy} and Year(dan) <= {$yil} and Year(gacha) >= {$yil}";

            //$query .= " where ism LIKE '%" . $_POST['ism'] . "%'";
        }


        $result = mysqli_query($connect, $query2) or die("So'rov ishlamadi : " . mysqli_error($connect));
        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

            echo "<p> zakazlar soni:  {$line['soni']}</p>";
        }
        ?>

        <a href="/chiqish.php" class="btn mx-2 btn-primary btn">Chiqish</a>

    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>