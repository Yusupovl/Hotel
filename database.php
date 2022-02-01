<?php

$connect = mysqli_connect("127.0.0.1", "root", "", "hotel", 3307)
    or die("Serverga bog'lanmadi : " . mysqli_error($connect));
