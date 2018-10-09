<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once '../../config/database.php';

    $sql = 'SELECT * FROM payment_methods';

    if ($result = mysqli_query($dbCon, $sql)) {

        $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($payments);
    }
}
die();