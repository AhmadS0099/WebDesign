<?php
include 'databaseConnect.php'; // Include database connection file
include 'databaseLogin.php';
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
    <img src="logo.png" alt="Logo" class="logo">
        <nav>
        <ul>
                <li><a href="index.php">Homepage</a></li>
                <li><a href="producten.php">Producten</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="winkelwagen.php">winkelwagen</a></li>

            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Winkelwagen</h2>
            <ul>
            <?php 
                // Controleer of de gebruikersnaam is ingesteld in de sessie
                if(isset($_SESSION['username'])){
                    // Haal de gebruikersnaam op uit de sessie
                    $username = $_SESSION['username'];

                    // Voorbereidde SQL-query om SQL-injecties te voorkomen
                    $sql = $conn->prepare("SELECT ProductName, Price, Sent FROM tblcart WHERE username = ?");
                    $sql->bind_param("s", $username);

                    // Executeer de SQL-query
                    $sql->execute();
                    
                    // Haal het resultaat op
                    $result = $sql->get_result();

                    // Controleer of er resultaten zijn
                    if ($result->num_rows > 0) {
                        // Loop door de resultaten en print elk rij
                        while ($row = $result->fetch_assoc()) {
                            echo "ProductName: " . $row['ProductName'] . "<br>";
                            echo "Price: €" . $row['Price']. "<br>";
                            if (  $row['Sent'] == true){
                                echo "Status : Verstuurd";
                            }else{
                                echo "Status : In behandeling";
                            }

                            echo "<form method='post' action='databaseLogin.php'>"; // Open het formulier
                            echo "<input type='hidden' name='product_name' value='" . $row['ProductName'] . "'>"; // Verborgen veld om productnaam door te geven
                            echo "<button type='submit'>Annuleren</button>"; // Knop om de bestelling te annuleren
                            echo "</form>"; // Sluit het formulier
                            echo "<hr>";
                        }
                    } else {
                        echo "Geen resultaten gevonden.";
                    }

                    // Sluit de prepared statement
                    $sql->close();
                } else {
                    echo "Gebruikersnaam niet ingesteld in de sessie.";
                }
            ?>

            </ul>

            <?php
    if(isset($_SESSION['username'])){
        // Haal de gebruikersnaam op uit de sessie
        $username = $_SESSION['username'];

        // Maak de prepared statement
        $sql = $conn->prepare("SELECT SUM(Price) AS TotalPrice FROM tblcart WHERE username = ?");
        
        // Controleer of de voorbereiding is gelukt
        if($sql === false) {
            echo "Error preparing SQL statement: " . $conn->error;
        } else {
            // Bind de parameter aan de statement
            $sql->bind_param("s", $username);
            
            // Executeer de prepared statement
            if ($sql->execute()) {
                // Haal het resultaat op
                $result = $sql->get_result();
                
                // Controleer of er rijen zijn teruggegeven
                if ($result->num_rows > 0) {
                    // Haal de data op uit de resultaten
                    $row = $result->fetch_assoc();
                    // Rond het totale bedrag af tot twee decimalen
                    $totalPrice = number_format($row['TotalPrice'], 2);
                    // Print het totale bedrag
                    echo "Total Price: €" . $totalPrice . "<br>";
                } else {
                    echo "No rows returned.";
                }
            } else {
                echo "Error executing SQL query: " . $sql->error;
            }
        }
    }
?>



            <form action="databaseLogin.php" method="post">
                <button type="submit" name="Afrekenen">Afrekenen</button>
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Webshop.</p>
    </footer>
</body>
</html>
