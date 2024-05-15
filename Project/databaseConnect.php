<?php
$servername = "localhost"; // Your server address
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$database = "webdesignwebsite"; // Your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Controleer of er een product ID en productnaam zijn verzonden vanuit de frontend
if(isset($_POST['product_prijs']) && isset($_POST['product_name']) && isset($_POST['username'])) {
    // Ontvang de product ID en productnaam vanuit de frontend
    $product_prijs = $_POST['product_prijs'];
    $product_name = $_POST['product_name'];
    $User_name = $_POST['username'];
    echo $User_name;

    // SQL-query om de product ID en productnaam naar de database op te slaan
    $sql = "INSERT INTO tblcart ( ProductName, Price, Username) VALUES ('$product_name', '$product_prijs', '$User_name')";

    if ($conn->query($sql) === TRUE) {
        echo "Product succesvol toegevoegd aan winkelwagen.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
}
?>
