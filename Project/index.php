<?php include 'databaseConnect.php';
function getProductsBySale() {
    global $conn;
    $stmt = $conn->prepare("SELECT Name, Sale, foto AS ImageURL, Omschrijving AS Description, Catagory AS Category, Merk AS Brand FROM product WHERE isonSale = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}


function displayProductsSale() {
    $products = getProductsBySale();
    foreach ($products as $product) {
        ?>
        <div>
        <img src="<?php echo $product["ImageURL"]; ?>" alt="Foto" class="Foto" width="200" height="200">
            <h3><?php echo $product["Name"]; ?></h3>
            <p>Sale Prijs: €<?php echo $product["Sale"]; ?></p>
            <p>Beschrijving: <?php echo $product["Description"]; ?></p>
        </div>
        <?php
    }
}

?>
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


        <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    
    </header>
    
    <main>
        <section>
            <h2>Aanbiedingen</h2>
            <div>
                <h3>Aanbieding 1</h3>
                <p>50% korting op alle schoenen!</p>
                <?php displayProductsSale(); ?>
            </div>
        </section>
    </main>
    
    <footer>
        <!-- Footer inhoud -->
        <p>© 2024 Webshop.</p>
    </footer>
</body>
</html>

