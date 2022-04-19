<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Description</title>
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
    
    $cake_id = $_GET['cake_id'];
    $sql_statement = "select cakeid, cakename, slices, status, price from cake where cakeid = $cake_id";
    $result = $conn->query($sql_statement);
    $row = $result->fetch_assoc();
    echo "<table class ='table table-bordered table-dark'>";

    echo "<tr><th>CAKE ID</th><td>".$row["cakeid"]."</td></tr>";
    echo "<tr><th>CAKE Name</th><td>".$row["cakename"]."</td></tr>";
    echo "<tr><th>Number of Slices</th><td>".$row["slices"]."</td></tr>";
    echo "<tr><th>Status</th><td>".$row["status"]."</td></tr>";
    echo "<tr><th>Price</th><td>".$row["price"]."</td></tr>";
    echo "</table>";
    $cid = $_SESSION['session_customer_id'];
    echo "<a href='cakes_by_custid.php?cust_id=$cid'><button>Back</button></a>";
    ?>
</body>
</html>