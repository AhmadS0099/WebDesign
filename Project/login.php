
<?php include 'databaseLogin.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
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
                <li><a href="admin.php">admin</a></li>
                
            </ul>
        </nav>
        <?php
                echo "Gebruikersnaam: " . $_SESSION['username'];
        ?>
    </header>
    
    <main>
        <section>
            <h2>Login / Register</h2>
            <form action="databaseLogin.php" method="post">
                <label for="username">Gebruikersnaam:</label><br>
                <input type="text" id="username" name="username"><br>
                <label for="password">Wachtwoord:</label><br>
                <input type="password" id="password" name="password"><br>
                <input type="submit" name="login" value="Login">
                <input type="submit" name="register" value="Register">
            </form>
        </section>
    </main>
    
    <footer>
        <p>© 2024 Webshop</p>
    </footer>
</body>
</html>
