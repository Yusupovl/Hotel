<?php
session_start();

/*
if (isset($_SESSION['user_id'])) {
    header('Location: /menu.php');
}
*/

require_once 'database.php';


$id = $_GET['id'];
$query = "SELECT * FROM xona_malumotlari where id = {$id}";
$result = mysqli_query($connect, $query);
$natija = mysqli_fetch_assoc($result);







$begin = new DateTime($dan);
$end = new DateTime($gacha);

$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($begin, $interval, $end);


foreach ($period as $dt) {
    echo $dt->format("l Y-m-d H:i:s\n");
    echo "<br>";
    echo "SELECT * from xona_bandligi where dan <= '" . $dt->format("Y-m-d") . "' and gacha >= '" . $dt->format("Y-m-d") . "'";
    echo "<br>";
    $result3 = $mysqli->query("SELECT * from xona_bandligi where dan <= '" . $dt->format("Y-m-d") . "' and  gacha >= '" . $dt->format("Y-m-d") . "'");
    while ($row = $result3->fetch_assoc()) {
        echo "{$row['xona_nomeri']}  ";
    }
    echo "<br>";
}



//$step = 1;

/*
if (isset($_POST['step']) && $_POST['step'] == 1) {



    $dan = $_POST['dan'];
    $gacha = $_POST['gacha'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "hotel";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Bazaga ulanib bo'lmadi: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM xona_bandligi";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo $row["dan"] . "<--->" . $row["gacha"] . "<br>";
    }

    $conn->close();




    */

















?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/asosiy.css">
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <title>Bookingroom</title>
</head>

<body>

    <div id="booking" class="section">
        <div class="section-center">
            <div class="container">
                <div class="row">
                    <div class="booking-form">
                        <div class="form-header">
                            <h1>Make your reservation</h1>
                        </div>
                        <form method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group"><span style="color:white;">dan</span> <input class="form-control" type="text" placeholder="yyyy/mm/dd" name="dan" required> </div>
                                    <span style="color:red;"><?php echo date($dan) ?></span>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group"><span style="color:white;">gacha</span> <input class="form-control" type="text" placeholder="yyyy/mm/dd" name="gacha" required><span style="color:red;"><?php echo $gacha ?></span></div>
                                </div>
                            </div>
                            <div class="form-group"> </div>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <div class="btn-primary"><?= $_SESSION['ismi'] ?></div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="btn-primary"><?= $_SESSION['tel_raqam'] ?> </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="btn-primary"><?= $natija['xona_nomeri'] ?> </div>
                                </div>
                            </div>

                            <?php



                            if (isset($_POST['buyurtma'])) {
                                $dan = $_POST['dan'];
                                $gacha = $_POST['gacha'];
                                $bool = 0;


                                $query = "SELECT *FROM xona_bandligi";
                                $result2 = mysqli_query($connect, $query);
                                while ($natija2 = mysqli_fetch_array($result2)) {
                                    if (($natija2['dan'] <= date($dan)) || ($natija2['gacha'] >= date($gacha)) || ($natija2['xona_nomeri'] == $natija['xona_nomeri'])) {
                                        $bool = 1;
                                    } else {
                                        // echo "<div style=\"color:white; text-align:center;\"> bo'sh xona  : " . $natija2["turi"] . "<--->" . $natija2["xona_nomeri"] . " - xona" .  "</div><br>";

                                    }
                                }

                                if ($bool == 0) {
                                    $query = "INSERT INTO xona_bandligi(dan,gacha,xona_nomeri,ism,tel_raqam) VALUES ('{$dan}','{$gacha}',{$natija['xona_nomeri']},'{$_SESSION['ismi']}','{$_SESSION['tel_raqam']}')";
                                    $result = mysqli_query($connect, $query);
                                    echo "xona band qilindi";
                                    header('refresh:2;url=/menu.php');
                                } else {
                                    echo "<div style=\"color:white;text-align:center;\"> xona band </div><br>";
                                    echo "<button class=\"submit-btn\" name=\"buyurtma\" type=\"submit\">boshqa xona kiritng</button>";
                                    echo "<a class=\"btn btn-primary\" href=\"menu.php\">boshqa xona kiritng</a>";
                                }

                                //bazaga qo'shish



                                //header('refresh:5;url=/menu.php');
                            }

                            ?>
                            <input type="hidden" name="step" value="2">

                            <?php if ($bool == 0) { ?>
                                <div class="form-btn"> <button class="submit-btn btn-primary" name="buyurtma" type="submit">Buyurtma qilish</button> </div>
                            <?php }  ?>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>