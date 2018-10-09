<?php
require_once "../config/database.php";

$invoiceId = $_GET['id'];

if ($invoiceId > 0) {

    //Keep track of number of product & payment inputs which are displayed to the user
    $countOfProductInputs = 0;
    $countOfPaymentInputs = 0;

    //Fetch all invoices
    $sql = 'SELECT * FROM invoices WHERE id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoice = $result->fetch_assoc();

    //If it can't be found, we can't continue
    if ($invoice == null) {
        header('Location: ' . '../index.php');
        die();
    }

    //Fetch all products linked to this invoice
    $sql = 'SELECT * FROM invoice_products WHERE invoice_id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoiceProducts = $result->fetch_all(MYSQLI_ASSOC);

    //Fetch all payments linked to this invoice
    $sql = 'SELECT * FROM invoice_payments WHERE invoice_id = ?';
    $statement = $dbCon->prepare($sql);
    $statement->bind_param('i', $invoiceId);
    $statement->execute();
    $result = $statement->get_result();
    $invoicePayments = $result->fetch_all(MYSQLI_ASSOC);

    //Fetch all products in order to populate dropdowns
    $products = [];
    $sql = 'SELECT * FROM products';
    if ($result = mysqli_query($dbCon, $sql)) {

        while($product = mysqli_fetch_assoc($result)){
            $products[$product['name']] = $product;
        }

    }

    //Fetch all payment methods in order to populate dropdowns
    $sql = 'SELECT * FROM payment_methods';
    if ($result = mysqli_query($dbCon, $sql)) {

        $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);


    }

}
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice Management</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>

<body>
<div class="container">
    <div class="row text-center">
        <h2>Edit Invoice # <?php echo $_GET['id'] ?></h2>
    </div>
    <div class="row text-center">
        <form method="post" action="process/edit.php">

            <h3>GENERAL</h3>
            <div class="form-group">
                <label for="customerName">Customer Name</label>
                <input type="text" class="form-control" id="customerName" placeholder="First & Last Name"
                       name="customerName">
            </div>
            <div class="form-group">
                <label for="customerAddress">Customer Address</label>
                <input type="text" class="form-control" id="customerAddress" placeholder="Address"
                       name="customerAddress">
            </div>

            <div class="form-group">
                <label for="invoiceDate">Invoice Date</label>
                <input type="date" class="form-control" id="invoiceDate" name="invoiceDate">
            </div>

            <div class="form-group">
                <label for="dueDate">Due Date</label>
                <input type="date" class="form-control" id="dueDate" name="dueDate">
            </div>
            <div class="form-group">
                <label for="note">Note</label>
                <textarea class="form-control" id="note" rows="3" name="note"></textarea>
            </div>

            <h3>PRODUCTS</h3>

            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <button type="button" class="btn btn-success" id="addProduct">+</button>
                    <button type="button" class="btn btn-danger" id="deleteProduct">X</button>
                </div>
            </div>



            <div class="container form-group" id="products">
                <?php
                foreach($invoiceProducts as $invoiceProduct){
                    $countOfProductInputs++;
                    echo '<div class ="row">';
                    echo '<div class=col-sm-3>';
                    echo '<label for="product' . $countOfProductInputs . '">Product</label>';
                    echo '<select class="form-control" name="productName' . $countOfProductInputs . '" data-product-number="' . $countOfProductInputs . '" id="product' . $countOfProductInputs . '">';
                    foreach($products as $product){
                        if($invoiceProduct['name'] === $product['name']){
                            echo '<option value="' . $product['name'] . '" selected>' . $product['name'] . '</option>';
                        }else{
                            echo '<option value="' . $product['name'] . '">' . $product['name'] . '</option>';
                        }
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class=col-sm-3>';
                    echo '<label for="productQuantity' . $countOfProductInputs . '">Quantity</label>';
                    echo '<input type="number" class="form-control" value="' . $invoiceProduct['quantity'] . '" id="productQuantity' . $countOfProductInputs . '" name="productQuantity' . $countOfProductInputs . '">';
                    echo '</div>';
                    echo '<div class=col-sm-3>';
                    echo '<label for="productPrice' . $countOfProductInputs . '">Price</label>';
                    echo '<input type="number" class="form-control" value="' . $invoiceProduct['price'] . '"id="productPrice' . $countOfProductInputs . '" name="productPrice' . $countOfProductInputs . '">';
                    echo '</div>';
                    echo '<div class=col-sm-3>';
                    echo '<label for="productTax' . $countOfProductInputs . '">Tax</label>';
                    echo '<input type="number" class="form-control" value="' . $invoiceProduct['tax'] . '"id="productTax' . $countOfProductInputs . '" name="productTax' . $countOfProductInputs . '">';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>

            <h3>PAYMENTS</h3>

            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <button type="button" class="btn btn-success" id="addPayment">+</button>
                    <button type="button" class="btn btn-danger" id="deletePayment">X</button>
                </div>
            </div>



            <div class="container form-group" id="payments">
                <?php
                foreach($invoicePayments as $invoicePayment){
                    $countOfPaymentInputs++;
                    echo '<div class ="row">';
                    echo '<div class=col-sm-6>';
                    echo '<label for="payment' . $countOfPaymentInputs . '">Payment Method</label />';
                    echo '<select class="form-control" name="paymentName' . $countOfPaymentInputs . '" data-payment-number="' . $countOfPaymentInputs . '" id="payment' . $countOfPaymentInputs . '">';
                    foreach($payments as $payment){
                        if($invoicePayment['payment_method'] === $payment['name']){
                            echo '<option value="' . $payment['name'] . '" selected>' . $payment['name'] . '</option>';
                        }else{
                            echo '<option value="' . $payment['name'] . '">' . $payment['name'] . '</option>';
                        }
                    }
                    echo '</select>';
                    echo '</div>';
                    echo '<div class=col-sm-6>';
                    echo '<label for="paymentAmount' . $countOfPaymentInputs . '">Amount</label>';
                    echo '<input type="number" class="form-control" value="' . $invoicePayment['payment_amount'] . '" id="paymentAmount' . $countOfPaymentInputs . '" name="paymentAmount' . $countOfPaymentInputs . '">';
                    echo '</div>';


                    echo '</div>';
                }
                ?>
            </div>

            <input type="hidden" value="<?php echo $countOfProductInputs ?>" id="countOfProductInputs">
            <input type="hidden" value="<?php echo $countOfPaymentInputs ?>" id="countOfPaymentInputs">
            <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id">


            <button type="submit" class="btn btn-primary">EDIT INVOICE</button>

        </form>
        <a class="btn btn-danger" style="margin-top: 20px" href="process/delete.php?id=<?php echo $_GET['id'] ?>">DELETE INVOICE</a>
    </div>
</div>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/create.js"></script>
</body>
</html>