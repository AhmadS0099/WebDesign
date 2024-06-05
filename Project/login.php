<?php include 'databaseLogin.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>
    <link rel="stylesheet" href="index.css">
    <style>
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
        }
        .icon.valid {
            background: url('https://banner2.cleanpng.com/20180318/zhw/kisspng-check-mark-computer-icons-clip-art-pictures-of-check-5aaecf12901540.1214743515214057145902.jpg') no-repeat center center;
            background-size: contain;
        }
        .icon.invalid {
            background: url('https://img.freepik.com/premium-vector/rode-kruis-x-op-een-transparante-achtergrond-voorraadvector_799714-207.jpg') no-repeat center center;
            background-size: contain;
        }
    </style>
    <script>
        function validateEmail() {
            var email = document.getElementById('email').value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.com$/;
            var icon = document.getElementById('email-icon');
            if (emailPattern.test(email)) {
                icon.className = 'icon valid';
                //document.getElementById('username').focus();
            } else {
                icon.className = 'icon invalid';
            }
        }


        function validateForm() {
            var email = document.getElementById('email').value;
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (!emailPattern.test(email)) {
                alert("Ongeldig e-mailadres.");
                return false;
            }
            
            var username = document.getElementById('username').value;
            return true;
        }
    </script>
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
        if (isset($_SESSION['username'])) {
            echo "Gebruikersnaam: " . $_SESSION['username'];
        }
        ?>
    </header>
    
    <main>
        <section>
            <h2>Login</h2>
            <form action="databaseLogin.php" method="post">
                <label for="username">Gebruikersnaam:</label><br>
                <input type="text" id="username" name="username"><br>
                <label for="password">Wachtwoord:</label><br>
                <input type="password" id="password" name="password"><br>

                <input type="submit" name="login" value="Login">
            </form>
        </section>

        <section>
            <h2>Register</h2>
            <form action="databaseLogin.php" method="post" onsubmit="return validateForm()">
                <label for="email">Email:</label><br> 
                <input type="text" id="email" name="email" onkeyup="validateEmail()">
                <span id="email-icon" class="icon"></span><br>
                <label for="username">Gebruikersnaam:</label><br>
                <input type="text" id="username" name="username"><br>
                <label for="password">Wachtwoord:</label><br>
                <input type="password" id="password" name="password"><br>
                <label for="WoonPlaats">WoonPlaats:</label><br>
                <input type="text" id="WoonPlaats" name="WoonPlaats"><br>
                <label for="Adres">Adres:</label><br>
                <input type="text" id="Adres" name="Adres"><br>
                <input type="submit" name="register" value="Register">
            </form>
        </section>
    </main>
    
    <footer>
        <p>© 2024 Webshop</p>
    </footer>
</body>
</html>
