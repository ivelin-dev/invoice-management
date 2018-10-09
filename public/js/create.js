let deleteProductBtn = $('#deleteProduct');
let addProductBtn = $('#addProduct');
let productsDiv = $('#products');
let products = [];
let countOfProductInputs = 0;

let payments = [];
let countOfPaymentInputs = 0;
let deletePaymentBtn = $('#deletePayment');
let addPaymentBtn = $('#addPayment');
let paymentsDiv = $('#payments');

let countOfProductInputsHidden = $('#countOfProductInputs');
let countOfPaymentInputsHidden = $('#countOfPaymentInputs');

if(countOfProductInputsHidden.val()){

    countOfProductInputs = countOfProductInputsHidden.val();
}
if(countOfPaymentInputsHidden.val()){

    countOfPaymentInputs = countOfPaymentInputsHidden.val();
}

$.post("/api/get-products.php", function (data, status) {
        products = JSON.parse(data);
    }
);

$.post("/api/get-payment-methods.php", function (data, status) {
        payments = JSON.parse(data);
    }
);


addProductBtn.click(function () {

    countOfProductInputs++;
    appendProductInputElements();

});
addPaymentBtn.click(function () {
    countOfPaymentInputs++;
    appendPaymentInputElements();
});

deleteProductBtn.click(function () {
    $('#products .row').last().remove();
});
deletePaymentBtn.click(function () {
    $('#payments .row').last().remove();
});

productsDiv.on('change', 'select', function () {
    selectedProduct = $(this).val();

    price = products[selectedProduct].price;
    tax = products[selectedProduct].tax_percent;

    productInputNumber = $(this).data('product-number');

    $('#productPrice' + productInputNumber).val(price);
    $('#productTax' + productInputNumber).val(tax);
});


function appendProductInputElements() {
    rowDiv = $('<div class="row" />');

    productDiv = $('<div class="col-sm-3" />');
    productLabel = $('<label for="product' + countOfProductInputs + '">Product</label />');
    productSelect = $('<select class="form-control" name="productName' + countOfProductInputs + '" data-product-number="' + countOfProductInputs + '" id="product' + countOfProductInputs + '">');

    blankOption = '<option value="" />';
    productSelect.append(blankOption);
    $.each(products, function (index, product) {
        option = '<option value="' + product.name + '">' + product.name + '</option>';
        productSelect.append(option);
    });


    productDiv.append(productLabel);
    productDiv.append(productSelect);

    quantityDiv = $('<div class="col-sm-3" />');
    quantityLabel = $('<label for="productQuantity' + countOfProductInputs + '">Quantity</label>');
    quantityInput = $('<input type="number" class="form-control" value="1" id="productQuantity' + countOfProductInputs + '" name="productQuantity' + countOfProductInputs + '">');
    quantityDiv.append(quantityLabel);
    quantityDiv.append(quantityInput);

    priceDiv = $('<div class="col-sm-3" />');
    priceLabel = $('<label for="productPrice' + countOfProductInputs + '">Price</label>');
    priceInput = $('<input type="number" class="form-control" id="productPrice' + countOfProductInputs + '" name="productPrice' + countOfProductInputs + '">');
    priceDiv.append(priceLabel);
    priceDiv.append(priceInput);

    taxDiv = $('<div class="col-sm-3" />');
    taxLabel = $('<label for="productTax' + countOfProductInputs + '">Tax</label>');
    taxInput = $('<input type="number" class="form-control" id="productTax' + countOfProductInputs + '" name="productTax' + countOfProductInputs + '">');
    taxDiv.append(taxLabel);
    taxDiv.append(taxInput);

    rowDiv.append(productDiv);
    rowDiv.append(quantityDiv);
    rowDiv.append(priceDiv);
    rowDiv.append(taxDiv);

    productsDiv.append(rowDiv);
}

function appendPaymentInputElements() {

    rowDiv = $('<div class="row" />');

    paymentDiv = $('<div class="col-sm-6" />');
    paymentLabel = $('<label for="payment' + countOfPaymentInputs + '">Payment Method</label />');
    paymentSelect = $('<select class="form-control" name="paymentName' + countOfPaymentInputs + '" data-payment-number="' + countOfPaymentInputs + '" id="payment' + countOfPaymentInputs + '">');

    blankOption = '<option value="" />';
    paymentSelect.append(blankOption);
    $.each(payments, function (index, payment) {
        option = '<option value="' + payment.name + '">' + payment.name + '</option>';
        paymentSelect.append(option);
    });

    paymentDiv.append(paymentLabel);
    paymentDiv.append(paymentSelect);


    amountDiv = $('<div class="col-sm-6" />');
    amountLabel = $('<label for="paymentAmount' + countOfPaymentInputs + '">Amount</label>');
    amountInput = $('<input type="number" class="form-control" id="paymentAmount' + countOfPaymentInputs + '" name="paymentAmount' + countOfPaymentInputs + '">');
    amountDiv.append(amountLabel);
    amountDiv.append(amountInput);


    rowDiv.append(paymentDiv);
    rowDiv.append(amountDiv);


    paymentsDiv.append(rowDiv);
}





