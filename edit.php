<?php
require_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    $id = $_GET['id'];
    $query = "SELECT * FROM xona_bandligi WHERE id = {$id}";
    $result = mysqli_query($connect, $query);
    $data = mysqli_fetch_assoc($result);

    ?>
    <form method="POST">
        <input type="text" name="dan" value="<?= $data['dan'] ?>">
        <input type="text" name="gacha" value="<?= $data['gacha'] ?>">
        <input type="text" name="xona_nomeri" value="<?= $data['xona_nomeri'] ?>">
        <input type="text" name="ism" value="<?= $data['ism'] ?>">
        <input type="text" name="tel_raqam" value="<?= $data['tel_raqam'] ?>">
        <input type="submit" value="Edit" name="addSubmit">
    </form>
    <?php
    if (isset($_POST['addSubmit'])) {
        $dan = $_POST['dan'];
        $gacha = $_POST['gacha'];
        $xona_nomeri = $_POST['xona_nomeri'];
        $ism = $_POST['ism'];
        $tel_raqam = $_POST['tel_raqam'];
        $dan = mysqli_real_escape_string($connect, $dan);
        $gacha = mysqli_real_escape_string($connect, $gacha);
        $xona_nomeri = mysqli_real_escape_string($connect, $xona_nomeri);
        $ism = mysqli_real_escape_string($connect, $ism);
        $tel_raqam = mysqli_real_escape_string($connect, $tel_raqam);
        $query = "UPDATE xona_bandligi SET `dan`='{$dan}' , `gacha`='{$gacha}', `xona_nomeri`='{$xona_nomeri}', `ism`='{$ism}', `tel_raqam`='{$tel_raqam}' WHERE `id`={$data['id']}";

        $result = mysqli_query($connect, $query) or die("So'rov ishlamadi : " . mysqli_error($connect));

        mysqli_close($connect);

        header('Location: /operator.php');
        exit;
    }
    ?>
</body>

</html>