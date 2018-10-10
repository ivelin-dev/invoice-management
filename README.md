# CONFIG
### SQL DUMP WITH DATA

The SQL dump with the database, tables and dummy data can be found in `config/database.php`.  

### CONFIG

Database connection defaults:  
Server: `localhost`  
Username: `root`  
Password: (none)  
Name: `invoice_management`  

These settings can be configured in `config/database.php`.  
Please remember to alter the SQL dump file if you do decide to change the database name.  

# THINGS THAT CAN BE IMPROVED

Please note this is a demo so some shortcuts were intentionally taken.

* Make all columns atomic (`customer_name` -> `customer_first_name` & `customer_last_name`; `customer_address` -> `customer_street` ...)
* `process/edit.php` should compare differences and `UPDATE` instead of what it is currently doing - `DELETE`ing all related records and then `INSERT`ing
* Implement user input validation
* Split queries into functions in a helper class
* Split `create.js` into `edit.js` & `create.js` since it's being used by both `edit.php` and `create.php` at the moment


# INSTRUCTIONS

**Scenario**
Hearing Center is a Canada wide hearing aid company that is rapidly expanding and constantly
adding new locations.

They currently have 3 clinics in Vancouver, Calgary and Toronto that have been around for 3
years. They are looking to build an invoice creation system to help them manage their orders
and run their business.

**Summary**
You will need to create a simple application that allows a user to create, view, edit and delete
an invoice for a customer.

**Requirements**

1. Create and design a MySQL database to store the products, orders etc. :white_check_mark:  
2. You will need to build this using PHP 5+ :white_check_mark:  

**Pages**

1. Dashboard – This page will be used to show and allow the user to manage the
    created invoices.  
       a. You will need to be able to access the create, edit and view invoice pages
          from here. :white_check_mark:  
       b. You will need to be able to delete an invoice from here. :white_check_mark:  
2. Create Invoice – this page will allow you to create a new invoice.  
    a. The first section will allow you to enter a customer name, their address,
       invoice date, invoice number, due date and note. :white_check_mark:  
    b. The second section will allow you to add new purchase line items by
       selecting a product, entering the quantity, price and tax. :white_check_mark:   
      These values should autoload upon selecting of the product while still
      allowing custom inputs. :white_check_mark:  
      You should be able to add and remove line items. :white_check_mark:  
    c. The third section will allow you to add new payment line items by selecting
    the payment type and entering the amount. :white_check_mark:  
    You need to be able to add and remove line items. :white_check_mark:  

3. View Invoice – This page will allow you to view the data that was entered in on the
    create invoice page.  
       a. The first section will be an overview containing the customer name, their
          address, invoice date, invoice number, due date and note. :white_check_mark:  
       b. The second section will contain both the purchase and payment line items
          with the product or payment name, quantity, price, tax and total. :white_check_mark:  
       c. The third section will contain the totals calculated from the invoice line
          items. :white_check_mark:  
4. Edit Invoice – This page will allow a user to make changes to the invoice they
    created.  
       a. This page should share the same design as the create invoice page but load
          with the values that were previously entered in. :white_check_mark:  
       b. In the first section you will need to be able to edit the customer name, their
          address, invoice date, invoice number, due date, and note. :white_check_mark:  
       c. In the second section you will need to be able to add, edit and delete product
          line items. :white_check_mark:  
       d. In the third section you will need to be able to add, edit and delete payment
          line items. :white_check_mark:  
       e. You will need to be able to delete an invoice from here. :white_check_mark:  

**Acceptance Criteria**
A simple functional application built with PHP and MySQL that will allow a user to create, view,
edit and delete invoices. :white_check_mark:  



