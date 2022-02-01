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
        <input type="submit" value="Delete" name="addSubmit">
    </form>
    <?php
    if (isset($_POST['addSubmit'])) {

        $query = "DELETE FROM xona_bandligi WHERE `id`={$data['id']}";

        $result = mysqli_query($connect, $query) or die("So'rov ishlamadi : " . mysqli_error($connect));

        mysqli_close($connect);

        header('Location: /operator.php');
        exit;
    }
    ?>
</body>

</html>