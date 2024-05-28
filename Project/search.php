<?php
include 'databaseConnect.php'; 
include 'databaseLogin.php'; 

/**
 * Retrieves products by search query from the database.
 *
 * @param string $query The search query to filter products by.
 * @return array An array of products matching the search query.
 */
function searchProducts($query) {
    global $conn;
    $stmt = $conn->prepare("SELECT Name, Price, foto AS ImageURL, Omschrijving AS Description, Catagory AS Category, Merk AS Brand FROM product WHERE Name LIKE ? OR Omschrijving LIKE ?");
    $searchTerm = "%" . $query . "%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}

/**
 * Displays search results based on the given query.
 *
 * @param string $query The search query.
 */
function displaySearchResults($query) {
    $products = searchProducts($query);

    echo "<h2>Zoekresultaten voor: " . htmlspecialchars($query) . "</h2>";

    if (empty($products)) {
        echo "<p>Geen producten gevonden.</p>";
        return;
    }

    foreach ($products as $product) {
        ?>
        <div>
            <img src="<?php echo htmlspecialchars($product["ImageURL"]); ?>" alt="Foto" class="Foto">            
            <h3><?php echo htmlspecialchars($product["Name"]); ?></h3>
            <p>Prijs: €<?php echo htmlspecialchars($product["Price"]); ?></p>
            <p>Beschrijving: <?php echo htmlspecialchars($product["Description"]); ?></p>
            <?php if (!empty($_SESSION['username'])): ?>
                <form action="databaseConnect.php" method="post">
                    <input type="hidden" name="product_prijs" value="<?php echo htmlspecialchars($product["Price"]); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product["Name"]); ?>">
                    <input type="hidden" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                    <button type="submit">Voeg toe aan winkelwagen</button>
                </form>
            <?php else: ?>
                <p>Log in om producten aan de winkelwagen toe te voegen.</p>
            <?php endif; ?>
        </div>
        <?php
    }
}

$query = isset($_GET['query']) ? $_GET['query'] : '';

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoekresultaten</title>
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
            <input type="text" name="query" placeholder="Zoek producten" value="<?php echo htmlspecialchars($query); ?>">
            <button type="submit">Zoeken</button>
        </form>
    </header>
    
    <main>
        <section>
            <div>
                <?php
                if (!empty($query)) {
                    displaySearchResults($query);
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
