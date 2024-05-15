<?php
    session_start(); // Start a session to store user login status
    include 'databaseConnect.php'; // Include database connection file
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If the form submitted is for registration
        if (isset($_POST['register'])) {
            // Get username and password from the form
            $input_username = $_POST['username'];
            $input_password = $_POST['password'];

            // Validate inputs
            if (!empty($input_username) && !empty($input_password)) {
                // Prepare SQL query to insert new user into the 'tbllogin' table
                $sql = "INSERT INTO tbllogin (Name, PassWord) VALUES ('$input_username', '$input_password')";

                if ($conn->query($sql) === TRUE) {
                    echo "Registration successful";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Username and password are required for registration";
            }
        } elseif (isset($_POST['login'])) { // If the form submitted is for login
            $input_username = $_POST['username'];
            $input_password = $_POST['password'];

            if (!empty($input_username) && !empty($input_password)) {
                // Call the stored procedure
                $stmt = $conn->prepare("CALL getUserAndPass(?, ?)");
                $stmt->bind_param("ss", $input_username, $input_password);
                $stmt->execute();
                $stmt->bind_result($username);

                $stmt->fetch();

                // Check if user is logged in
                if ($username !== null) {
                    // User found, set session variables and redirect to homepage or any other page
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("Location: index.php"); // Redirect to homepage after successful login
                    exit();
                } else {
                    // No user found with provided credentials
                    echo "Invalid username or password";
                }
            } else {
                echo "Username and password are required for login";
            }
        } elseif (isset($_POST['Adminlogin'])) {
            $input_username = $_POST['username'];
            $input_password = $_POST['password'];

            if (!empty($input_username) && !empty($input_password)) {
                // Call the stored procedure
                $stmt = $conn->prepare("CALL getAdminPass(?, ?)");
                $stmt->bind_param("ss", $input_username, $input_password);
                $stmt->execute();
                $stmt->bind_result($username);

                $stmt->fetch();

                // Check if user is logged in
                if ($username !== null) {
                    // User found, set session variables and redirect to homepage or any other page
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    header("Location: Control.php"); // Redirect to homepage after successful login
                    exit();
                } else {
                    // No user found with provided credentials
                    echo "Invalid username or password";
                }
            } else {
                echo "Username and password are required for login";
            }
        }
        if(isset($_POST['product_name'])) {
            // Haal de productnaam op uit de POST-variabele
            $productName = $_POST['product_name'];
    
            // Verwijder de bestelling met de opgegeven productnaam voor de huidige gebruiker
            $username = $_SESSION['username'];
            $deleteQuery = "DELETE FROM tblcart WHERE username='$username' AND ProductName='$productName'";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Bestelling succesvol geannuleerd.";
                header("Location: winkelwagen.php");
            } else {
                echo "Fout bij annuleren van bestelling: " . $conn->error;
            }
        } else {
            echo "Productnaam niet ontvangen.";
        }
    }
?>