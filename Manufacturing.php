<?php

$serverName = 'localhost';
$userName = 'omer_shakeel_17902';
$password = '123456';
$database = 'omair_mairaj_17849';
$conn = mysqli_connect($serverName, $userName, $password, $database);
$customer_email = "";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $update = "UPDATE warranty_claim SET Status = 'Completed' WHERE Claim_id = $id";
    $run = mysqli_query($conn, $update);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manufacturing Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Manufacturing.css">

</head>
<body>
    <h1 class="logo">LOGO</h1>
    <div class="banner-area">
        <header>
            <h1 class="heading">Manufacturing Department</h1>
        </header>
        <a class="btnlogout" href="logout.php">Logout</a>
        <div class="container">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th>Claim ID</th>
                        <th>Fault Description</th>
                        <th>Product ID</th>
                        <th>Customer ID</th>
                        <th>Sales Order No</th>
                        <th>Exp_Date</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $serverName = 'localhost';
                    $userName = 'omer_shakeel_17902';
                    $password = '123456';
                    $database = 'omair_mairaj_17849';
                    $conn = mysqli_connect($serverName, $userName, $password, $database);
                    $select = "SELECT * FROM warranty_claim WHERE Status = 'Repairing'";

                    $run = mysqli_query($conn, $select);
                    while ($row_claim = mysqli_fetch_array($run)) {
                        $claim_id = $row_claim['Claim_id'];
                        $desc = $row_claim['Fault_Description'];
                        $product = $row_claim['Product_id'];
                        $customer = $row_claim['Customer_id'];
                        $saleno = $row_claim['Sale_Order_No'];
                        $date = $row_claim['Exp_Date'];
                        $status = $row_claim['Status'];

                    ?>
                        <tr>
                            <td><?php echo $claim_id; ?></td>
                            <td><?php echo $desc; ?></td>
                            <td><?php echo $product; ?></td>
                            <td><?php echo $customer; ?></td>
                            <td><?php echo $saleno; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><?php echo $status; ?></td>
                            <td width=110px align="center"><a class="btnstatus" type="submit" name="completebtn" onClick="return confirm('Confirm Completion?')" href="Manufacturing.php?id=<?php echo $claim_id; ?>" value="Complete">Complete</a></td>
                        </tr>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>