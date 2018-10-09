<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    require_once '../../config/database.php';

    $products = [];

    $sql = 'SELECT * FROM products';
    if ($result = mysqli_query($dbCon, $sql)) {

        while($product = mysqli_fetch_assoc($result)){
            $products[$product['name']] = $product;
        }
        echo json_encode($products);
    }
}
die();