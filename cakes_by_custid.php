<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <?php
    session_start();
    $server_name = "localhost";
    $user_name = "root";
    $password  = "";
    $db_name = "bakery";

    $conn = new mysqli($server_name, $user_name, $password, $db_name);

    if($conn->connect_error){
        die("Connecting to Database Failed: ".$conn->connect_error);
    }
    $customer_id = $_GET["cust_id"];
    $_SESSION['session_customer_id'] = $customer_id;
    // select o.cakeid,o.ordertime,o.pickuptime,o.pricepaid,c.cakename from orders o natural join cake c
    // order by ordertime desc 


    $sql_statement = "Select o.cakeid, o.ordertime,o.pickuptime,o.pricepaid,c.cakename from orders o natural join cake c where custid = $customer_id order by ordertime desc";
    $result = $conn->query($sql_statement);
    if($result->num_rows > 0){
        $table_class = " class ='table table-bordered table-dark'";
        echo "<table$table_class>";
        echo"<tr><th>Cake Id</th><th>Cake Name</th><th>Order Time</th><th>Pick up Time</th><th>Price Paid</th><th>Display</th></tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr><td>".$row["cakeid"]."</td><td>".$row["cakename"]."</td><td>".$row["ordertime"]."</td><td>".$row["pickuptime"]."</td><td>".$row["pricepaid"]."</td>";
            $ckid = $row["cakeid"];
            echo "<td><a href='cake_description_by_cakeid.php?cake_id=$ckid'><button>Display</button></a></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<td><a href='base.php'><button>Back</button></a></td>";
    }
    else{
        echo "<h1>No results to show. The user either doesn't exist or hasn't ordered anything<h1>";
    }
    $conn->close();

    ?>
    <!-- http://localhost/assignment3-1/cakes_by_custid.php -->
</body>
</html>
