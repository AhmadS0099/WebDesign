<?php
include 'databaseConnect.php'; 
include 'databaseLogin.php'; 

/**
 * Retrieves products by category from the database.
 *
 * @param int $category The ID of the category to filter products by.
 * @return array An array of products in the specified category.
 */
function getProductsByCategory($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT Name, Price, Sale, isOnSale, foto AS ImageURL, Omschrijving AS Description, Catagory AS Category, Merk AS Brand FROM product WHERE Catagory = ?");
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

/**
 * Retrieves the description of a category from the database.
 *
 * @param int $category The ID of the category.
 * @return string The description of the category.
 */
function getCategoryDescription($category) {
    global $conn;
    $stmt = $conn->prepare("SELECT Omschrijving FROM category WHERE Id = ?");
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $stmt->bind_result($description);
    $stmt->fetch();
    $stmt->close();
    return $description;
}

function displayProducts($category) {
    $description = getCategoryDescription($category);
    echo "<p> $description</p>";
    
    $products = getProductsByCategory($category);
    foreach ($products as $product) {
        ?>
        <div>
            <img src="<?php echo $product["ImageURL"]; ?>" alt="Foto" class="Foto">
            <h3><?php echo $product["Name"]; ?></h3>
            <?php
            if ($product["isOnSale"] == 1) {
                echo "<p>SALE: Oude prijs: €" . $product["Price"] . ", Nieuwe prijs: €" . $product["Sale"] . "</p>";
                $finalPrice = $product["Sale"];
            } else {
                echo "<p>Prijs: €" . $product["Price"] . "</p>";
                $finalPrice = $product["Price"];
            }
            ?>
            <p>Beschrijving: <?php echo $product["Description"]; ?></p>
            <form action="databaseConnect.php" method="post">
                <input type="hidden" name="product_prijs" value="<?php echo $finalPrice; ?>">
                <input type="hidden" name="product_name" value="<?php echo $product["Name"]; ?>">
                <?php
                if(!empty($_SESSION['username'])){
                    ?>
                    <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
                    <button type="submit">Voeg toe aan winkelwagen</button>
                <?php
                }
                ?>
                
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
                <li><a href="winkelwagen.php">Winkelwagen</a></li>
            </ul>
        </nav>
        <form action="search.php" method="get">
            <input type="text" name="query" placeholder="Zoek producten">
            <button type="submit">Zoeken</button>
        </form>
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
            <h2>Overige</h2>
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
