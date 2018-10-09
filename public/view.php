<?php
require_once "../config/database.php";

$invoiceId = $_GET['id'];

if ($invoiceId > 0) {

    $sql = 'SELECT * FROM invoices WHERE id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoice = $result->fetch_assoc();

    if ($invoice == null) {
        header('Location: ' . '../index.php');
        die();
    }

    $invoiceTotal = 0;

    $sql = 'SELECT * FROM invoice_products WHERE invoice_id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoiceProducts = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($invoiceProducts as &$product) {
        $costPriorToTax = $product['price'] * $product['quantity'];
        $tax = $costPriorToTax * $product['tax'] / 100;
        $total = $costPriorToTax + $tax;

        $product['total'] = $total;

        $invoiceTotal += $total;
    }

    $sql = 'SELECT * FROM invoice_payments WHERE invoice_id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoicePayments = $result->fetch_all(MYSQLI_ASSOC);

    foreach($invoicePayments as $payment){
        $invoiceTotal -= $payment['payment_amount'];
    }



}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice # <?php echo $_GET['id'] ?></title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>
<div class="container">
    <div class="row text-center">
        <h3>Invoice # <?php echo $_GET['id'] ?></h3>
    </div>
    <div class="row text-center">
        <div class="panel-group">
            <div class="panel panel-default">
                <div class="panel-heading">GENERAL</div>
                <div class="panel-body">
                    <strong>Customer Name:</strong> <?php echo $invoice['customer_name'] ?> <br>
                    <strong>Customer Address:</strong> <?php echo $invoice['customer_address'] ?> <br>
                    <strong>Invoice </strong> <?php echo $invoice['date'] ?> <br>
                    <strong>Invoice #:</strong> <?php echo $invoice['id'] ?> <br>
                    <strong>Due Date:</strong> <?php echo $invoice['due_date'] ?> <br>
                    <strong>Note:</strong> <?php echo $invoice['note'] ?> <br>
                </div>
            </div>
            <div class="panel panel-default">

                <div class="panel-heading">Products & Payments</div>
                <div class="panel-body">
                    <h5>PRODUCTS:</h5>
                    <?php
                    foreach ($invoiceProducts as $product) {
                        echo '<strong>Product Name:</strong>' . $product['name'] . '<br>';
                        echo '<strong>Quantity:</strong>' . $product['quantity'] . '<br>';
                        echo '<strong>Price:</strong>$' . $product['price'] . '<br>';
                        echo '<strong>Tax:</strong>' . $product['tax'] . '%<br>';
                        echo '<strong>Total:</strong>' . $product['total'] . '<br>';
                        echo '<hr>';
                    }
                    ?>
                    <h5>PAYMENTS:</h5>
                    <?php
                    foreach ($invoicePayments as $payment) {
                        echo '<strong>Payment Method:</strong>' . $payment['payment_method'] . '<br>';
                        echo '<strong>Amount:</strong>' . $payment['payment_amount'] . '<br>';
                        echo '<hr>';
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">TOTAL OUTSTANDING</div>
                <div class="panel-body">
                    <strong>$<?php echo $invoiceTotal ?></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>