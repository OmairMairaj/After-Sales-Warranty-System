<?php

$serverName = 'localhost';
$userName = 'omer_shakeel_17902';
$password = '123456';
$database = 'omair_mairaj_17849';
$conn = mysqli_connect($serverName, $userName, $password, $database);
$customer_email = "";

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $update = "UPDATE warranty_claim SET Status = 'Repairing' WHERE Claim_id = $id";
    $run = mysqli_query($conn, $update);
}

if (!empty($_GET['id2'])) {
    $id = $_GET['id2'];
    $update = "UPDATE warranty_claim SET Status = 'Replacing' WHERE Claim_id = $id";
    $run = mysqli_query($conn, $update);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ManagerPage.css">

</head>

<body>
    <h1 class="logo">LOGO</h1>
    <div class="banner-area">
        <header>
            <h1 class="heading">Warranty Claims</h1>
        </header>
        <a class="btnlogout" href="logout.php">Logout</a>
        <div class="container">
            <table class="table table-dark">
                <div class="table-responsive">
                    <div max-width: 700px; margin: auto;>
                        <thead align="center">
                            <tr>
                                <th>Claim ID</th>
                                <th>Fault Description</th>
                                <th>Product ID</th>
                                <th>Customer Email</th>
                                <th>Sales Order No</th>
                                <th>Exp-Date</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody align="center">
                            <?php

                            $serverName = 'localhost';
                            $userName = 'omer_shakeel_17902';
                            $password = '123456';
                            $database = 'omair_mairaj_17849';
                            $conn = mysqli_connect($serverName, $userName, $password, $database);
                            $select = "SELECT Claim_id,Fault_Description,Product_id,c.Email,Sale_Order_No,Exp_Date,Status FROM `warranty_claim`, `customers` c WHERE warranty_claim.Customer_id = c.Customer_id ORDER BY Timestamp DESC";

                            $run = mysqli_query($conn, $select);
                            while ($row_claim = mysqli_fetch_array($run)) {
                                $claim_id = $row_claim['Claim_id'];
                                $desc = $row_claim['Fault_Description'];
                                $product = $row_claim['Product_id'];
                                $customer = $row_claim['Email'];
                                $saleno = $row_claim['Sale_Order_No'];
                                $exp_date = $row_claim['Exp_Date'];
                                $status = $row_claim['Status'];

                            ?>
                                <tr>
                                    <td><?php echo $claim_id; ?></td>
                                    <td><?php echo $desc; ?></td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $customer; ?></td>
                                    <td><?php echo $saleno; ?></td>
                                    <td><?php echo $exp_date; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td width=110px align="center"><a class="btnstatus" type="submit" name="repairbtn" onClick="return confirm('Send for Repairing?')" href="ManagerPage.php?id=<?php echo $claim_id; ?>" value="Repair">Repair</a></td>
                                    <td width=110px align="center"><a class="btnstatus" type="submit" name="replacebtn" onClick="return confirm('Send for Replacement?')" href="ManagerPage.php?id2=<?php echo $claim_id; ?>" value="Replace">Replace</a></td>
                                    <td><a href="mailto:<?php echo $customer; ?>"><i class="fa fa-envelope"></i></a></td>
                                    
                                </tr>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </div>
                </div>
            </table>
        </div>
    </div>
</body>

</html>