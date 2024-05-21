<?php
include 'databaseConnect.php'; // Include database connection file
include 'databaseLogin.php'; 

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="producten.css">
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
                <li><a href="bestellingen.php">Alle bestellingen</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section>
            <h2>Admin Login </h2>
            <form action="databaseLogin.php" method="post">
                <label for="username">Gebruikersnaam:</label><br>
                <input type="text" id="username" name="username"><br>
                <label for="password">Wachtwoord:</label><br>
                <input type="password" id="password" name="password"><br>
                <input type="submit" name="Adminlogin" value="AdminLogin">
            </form>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Webshop.</p>
    </footer>
</body>
</html>
