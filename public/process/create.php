<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../../config/database.php";

    $customerName = $_POST['customerName'];
    $customerAddress = $_POST['customerAddress'];
    $invoiceDate = $_POST['invoiceDate'];
    $dueDate = $_POST['dueDate'];
    $note = $_POST['note'];

    //1. Insert invoices
    $sql = 'INSERT INTO invoices (customer_name, customer_address, date, due_date, note) VALUES (?, ?, ?, ?, ?)';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('sssss', $customerName, $customerAddress, $invoiceDate, $dueDate, $note);
    $statement->execute();

    $invoiceId = $statement->insert_id;

    //2. Insert all linked products (variable number of them)
    $productCount = 1;
    foreach ($_POST as $key => $value) {

        if (strpos($key, 'productName') === 0) {

            $name = $_POST['productName' . $productCount];
            $quantity = $_POST['productQuantity' . $productCount];
            $price = $_POST['productPrice' . $productCount];
            $tax = $_POST['productTax' . $productCount];

            $sql = 'INSERT INTO invoice_products (invoice_id, `name`, quantity, price, tax) VALUES (?, ?, ?, ?, ?)';
            $statement = $dbCon->prepare($sql);
            $statement->bind_param('isiii', $invoiceId, $name, $quantity, $price, $tax);
            $res = $statement->execute();
            $productCount++;
        }

    }

    //3. Insert all payments (variable number of them)
    $paymentCount = 1;
    foreach ($_POST as $key => $value) {

        if (strpos($key, 'paymentName') === 0) {

            $name = $_POST['paymentName' . $paymentCount];
            $amount = $_POST['paymentAmount' . $paymentCount];

            $sql = 'INSERT INTO invoice_payments (invoice_id, payment_method, payment_amount) VALUES (?, ?, ?)';
            $statement = $dbCon->prepare($sql);
            $statement->bind_param('isi', $invoiceId,$name, $amount );
            $res = $statement->execute();
            $paymentCount++;
        }

    }


    header('Location: ' . '../index.php');
    die();
}
