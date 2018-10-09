<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if ($_GET['id'] > 0) {

        require_once "../../config/database.php";

        $invoiceId = $_GET['id'];

        //1. Delete invoices
        $sql = 'DELETE FROM invoices WHERE id = ?';
        $statement = $dbCon->prepare($sql);
        $statement->bind_param('i', $invoiceId);
        $statement->execute();

        //2. Delete linked products
        $sql = 'DELETE FROM invoice_products WHERE invoice_id = ?';
        $statement = $dbCon->prepare($sql);
        $statement->bind_param('i', $invoiceId);
        $statement->execute();

        //3. Delete payments
        $sql = 'DELETE FROM invoice_payments WHERE invoice_id = ?';
        $statement = $dbCon->prepare($sql);
        $statement->bind_param('i', $invoiceId);
        $statement->execute();
    }

    header('Location: ' . '../index.php');
    die();
}


