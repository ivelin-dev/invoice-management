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
        <h2>Create an Invoice</h2>
    </div>
    <div class="row text-center">
        <form method="post" action="process/create.php">

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
            </div>

            <h3>PAYMENTS</h3>

            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <button type="button" class="btn btn-success" id="addPayment">+</button>
                    <button type="button" class="btn btn-danger" id="deletePayment">X</button>
                </div>
            </div>

            <div class="container form-group" id="payments">
            </div>


            <button type="submit" class="btn btn-primary">CREATE INVOICE</button>

        </form>
    </div>
</div>

<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/create.js"></script>
</body>
</html>