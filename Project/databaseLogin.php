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
            $input_WoonPlaats = $_POST['WoonPlaats'];
            $input_Adres = $_POST['Adres'];
            $email = $_POST['email'];
            
    
            // Generate a unique activation code
            $activationCode = bin2hex(random_bytes(16));
    
            // Prepare SQL query to insert new user into the 'tbllogin' table
            $sql = "INSERT INTO tbllogin (Name, PassWord, Adres, WoonPlaats, activation_code) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $input_username, $input_password, $input_Adres, $input_WoonPlaats, $activationCode);
    
            if ($stmt->execute()) {
                // Registration successful
                // Send welcome note
                $welcomeMessage = "Welcome, $input_username! Thank you for registering.";
                // Example of sending an email
                $to = $email; // Change to the user's email address
                $subject = 'Welcome to our website';
                $message = "Hello, $input_username! Thank you for registering.";
                $headers = 'From: your_email@example.com'; // Change this to your email address
    
                if (mail($to, $subject, $message, $headers)) {
                    echo "Registration successful. Welcome email sent.";
                    header("Location: Extra.php"); 
                } else {
                    echo "Registration successful, but failed to send welcome email.";
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    
            // Close the statement
            $stmt->close();
        }  
        elseif (isset($_POST['login'])) { // If the form submitted is for login
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
        } elseif(isset($_POST['product_name'])) {
            // Haal de productnaam op uit de POST-variabele
            $productName = $_POST['product_name'];
    
            // Verwijder de bestelling met de opgegeven productnaam voor de huidige gebruiker
            $username = $_SESSION['username'];
            $deleteQuery = "DELETE FROM tblcart WHERE username='$username' AND ProductName='$productName' LIMIT 1";
            if ($conn->query($deleteQuery) === TRUE) {
                echo "Bestelling succesvol geannuleerd.";
                header("Location: winkelwagen.php");
            } else {
                echo "Fout bij annuleren van bestelling: " . $conn->error;
            }
        } 
        if(isset($_POST['Afrekenen'])) {
            // De gebruiker klikt op "Afrekenen" knop
            // We willen de bestelling van de huidige gebruiker markeren als "Verstuurd"
        
            // Haal de gebruikersnaam op uit de sessie
            $username = $_SESSION['username'];
        
            // Voorbereidde SQL-query om SQL-injecties te voorkomen
            $sql = $conn->prepare("UPDATE tblcart SET Sent = 1 WHERE Username = ?");
            $sql->bind_param("s", $username);
        
            // Executeer de SQL-query
            if ($sql->execute()) {
                // De bestelling is succesvol gemarkeerd als "Verstuurd"
                header("Location: winkelwagen.php");
                exit; // Zorg ervoor dat er geen extra output is voordat de header wordt verzonden
            } else {
                // Er is een fout opgetreden bij het markeren van de bestelling
                echo "Fout bij het afrekenen: " . $sql->error;
            }
        
            // Sluit de prepared statement
            $sql->close();
        }

    }
?>