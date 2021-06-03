<?php
$conn = mysqli_connect('localhost', 'omer_shakeel_17902', '123456', 'omair_mairaj_17849');

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
//   }
//   echo "Connected successfully";
$Fault_Description = "";
$Product_id = "";
$Product_Name = "";
$Customer_id = "";
$Customer_Name = "";
$Claim_id = "000000";
$Sale_Order_No = null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Claim Page</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="ClaimPage.css">

</head>

<body>
    <h1 class="logo">LOGO</h1>
    <div class="banner-area">
        <header>
            <h1 class="heading">Warranty Claim Form</h1>
        </header>
        <form class="search-form" action="" method="get" role="search">
            <label class="searchlabel" for="search">Search Sales Order No</label>
            <div>
                <input id="search" type="search" name="Sale_Order_No" placeholder="Search..." autofocus required />
                <button class="searchbutton" name="SearchButton" type="search">Go</button>
            </div>
            <br />
            <?php
            if (isset($_GET['SearchButton'])) {
                $Sale_Order_No = $_GET['Sale_Order_No'];
                if (empty($Sale_Order_No)) {
                    $Sale_Order_No = "";
                    $Customer_id = "";
                    $Customer_Name = "";
                    $Product_id = "";
                    $Product_Name = "";
                    $Sale_Date = "";
                    $Exp_Date = "";
                } else {
                    // $select = "SELECT * FROM sale_orders WHERE Sale_Order_No ='$Sale_Order_No'";
                    $select = "SELECT s.Sale_Order_No,p.Product_id,p.Product_Name,s.Sale_Date,s.Warranty_Expiration,c.Customer_id,c.Customer_Name 
                    FROM `sale_orders` s,products p,customers c WHERE s.Product_id = p.Product_id AND s.Customer_id = c.Customer_id 
                    AND Sale_Order_No = '$Sale_Order_No'";
                    $run = mysqli_query($conn, $select);
                    $row_sale = mysqli_fetch_array($run);
                    if ($row_sale) {
                        $Sale_Order_No = $row_sale['Sale_Order_No'];
                        $Customer_id = $row_sale['Customer_id'];
                        $Customer_Name = $row_sale['Customer_Name'];
                        $Product_id = $row_sale['Product_id'];
                        $Product_Name = $row_sale['Product_Name'];
                        $Sale_Date = $row_sale['Sale_Date'];
                        $Exp_Date = $row_sale['Warranty_Expiration'];
                        $Claim_id = rand(100000, 999999);
                    } else {
                        echo "<p><font color=white size=2.5px>No such Sale Order Exists.</font></p>";
                    }
                }
            }
            ?>

            <form class="form" action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Product ID</label>
                    <input type="int" name="Product_id" class="form-control" placeholder="" value="<?php echo $Product_id; ?>">
                </div>
                <div class="form-group">
                    <label>Product Name</label>
                    <input value="<?php echo $Product_Name; ?>" type="text" name="Product_Name" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Sale Date</label>
                    <input value="<?php echo $Sale_Date; ?>" type="date" name="Sale_Date" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Customer ID</label>
                    <input value="<?php echo $Customer_id; ?>" type="int" name="Customer_id" class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label>Customer Name</label>
                    <input value="<?php echo $Customer_Name; ?>" type="text" name="Customer_Name" class="form-control" placeholder="">
                </div>
            </form>
        </form>
        <div>
            <div class="centered">
            </div>
            <div class="split right">
                <a class="btnlogout" href="logout.php">Logout</a>
                <div class="centered-right">
                    <form class="form" action="" method="post" enctype="multipart/form-data">
                        <div class="form-group-id">
                            <label>Warranty Tracking Number</label>
                            <div>
                                <label placeholder="#000000" name="Claim_id"><?php echo '#' . $Claim_id; ?></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Expiration Date</label>
                            <input value="<?php echo $Exp_Date; ?>" type="date" name="Exp_Date" class="form-control" placeholder="">
                        </div>
                        <br />
                        <div class="form-group">
                            <label>Fault Description</label>
                            <textarea value="<?php echo $Fault_Description; ?>" type="textarea" name="Fault_Description" class="desc-box" placeholder="" rows="4" cols="50" style="width: 100%; height: 150px;"></textarea>
                        </div>
                        <div>
                            <input class="FileButton" type="submit" name="submit-btn" value="File for Warranty"></input>
                        </div>
                    </form>

                    <?php

                    if (isset($_POST['submit-btn'])) {
                        $Fault_Description = $_POST['Fault_Description'];
                        $Exp_Date = $_POST['Exp_Date'];
                        $insert = "INSERT INTO warranty_claim(Claim_id,Customer_id,Product_id,Sale_Order_No,Fault_Description,Exp_Date) 
	                    VALUES($Claim_id,'$Customer_id','$Product_id','$Sale_Order_No','$Fault_Description','$Exp_Date')";
                        $run_insert = mysqli_query($conn, $insert);

                        if ($run_insert == true) {
                            echo "Warranty Claim Filed";
                        } else {
                            echo "Try Again";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>