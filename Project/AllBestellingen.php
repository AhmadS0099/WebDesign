<?php
include 'databaseConnect.php'; 
include 'databaseLogin.php'; 

/**
 * Retrieves the all prodcuts from the database
 * 
 * @return string All prodcuts from the database
 */
function getAllProducts() {
    global $conn;
    $stmt = $conn->prepare("SELECT Username, ProductName, Price, Sent FROM tblcart");
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
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
    </header>
    
    <main>
        <section>
            <h2>All Products</h2>
            <div>
                <?php
                $products = getAllProducts();
                foreach ($products as $product) {
                    ?>
                    <div class="product">
                        <h3><?php echo htmlspecialchars($product["ProductName"]); ?></h3>
                        <div class="product-info">
                            <p>Price: €<?php echo htmlspecialchars($product["Price"]); ?></p>
                            <p>Username: <?php echo htmlspecialchars($product["Username"]); ?></p>
                            <p>Sent: <?php echo htmlspecialchars($product["Sent"] ? 'Yes' : 'No'); ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Webshop.</p>
    </footer>
</body>
</html>

