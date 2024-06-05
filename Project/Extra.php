<?php include 'databaseConnect.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
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
    <style>
        .fullscreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .exit-button {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 100;
        }
    </style>

    <iframe class="fullscreen" src="https://www.youtube.com/embed/k1BneeJTDcU?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    <!-- Add this button to your HTML body to allow users to exit the fullscreen video and go back to index.php -->
    <button class="exit-button" onclick="window.location.href='index.php'">Exit Fullscreen</button>

    </main>
    
    <footer>
        <!-- Footer inhoud -->
        <p>© 2024 Webshop.</p>
    </footer>
</body>
</html>
