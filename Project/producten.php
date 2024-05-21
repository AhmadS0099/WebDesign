<?php
include 'databaseConnect.php'; 
include 'databaseLogin.php'; 

function getProductsByCategory($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT Name, Price, foto AS ImageURL, Omschrijving AS Description, Catagory AS Category, Merk AS Brand FROM product WHERE Catagory = ?");
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

function displayProducts($category) {
    $products = getProductsByCategory($category);
    foreach ($products as $product) {
        ?>
        <div>
            <img src="<?php echo $product["ImageURL"]; ?>" alt="Foto" class="Foto">            
            <h3><?php echo $product["Name"]; ?></h3>
            <p>Prijs: €<?php echo $product["Price"]; ?></p>
            <p>Beschrijving: <?php echo $product["Description"]; ?></p>
            <form action="databaseConnect.php" method="post">
                <input type="hidden" name="product_prijs" value="<?php echo $product["Price"]; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product["Name"]; ?>">
                <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                <button type="submit">Voeg toe aan winkelwagen</button>
            </form>
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
            </ul>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Laptops</h2>
            <div>
                <?php displayProducts(1); ?>
            </div>
        </section>

        <section>
            <h2>Smartphones</h2>
            <div>
                <?php displayProducts(2); ?>
            </div>
        </section>

        <section>
            <h2>Smartwatches</h2>
            <div>
                <?php displayProducts(3); ?>
            </div>
        </section>

        <section>
            <h2> Other </h2>
            <div>
                <?php displayProducts(4); ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Webshop.</p>
    </footer>
</body>
</html>
