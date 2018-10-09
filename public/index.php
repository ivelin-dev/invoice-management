<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Invoice Management</title>

    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

</head>

<body>
<div class="container">
    <div class="row text-center">
        <h3>Invoice Dashboard</h3>
    </div>
    <div class="row text-right">
        <a class="btn btn-success" href="create.php">CREATE +</a>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">INVOICE #</th>
                <th scope="col">DATE</th>
                <th scope="col">DUE DATE</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <?php
            require_once "../config/database.php";

            $sql = 'SELECT * FROM invoices';
            if ($result = mysqli_query($dbCon, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['date'] . '</td>';
                        echo '<td>' . $row['due_date'] . '</td>';
                        echo '<td>
                                <a class="btn btn-default" href="view.php?id=' . $row['id'] . '">VIEW</a>
                                <a class="btn btn-primary" href="edit.php?id=' . $row['id'] . '">EDIT</a>
                                <a class="btn btn-danger" href="process/delete.php?id=' . $row['id'] . '">DELETE</a> </td>';
                        echo '</tr>';
                    }

                }
            }
            ?>
            </tbody>
        </table>

    </div>


</body>
</html>