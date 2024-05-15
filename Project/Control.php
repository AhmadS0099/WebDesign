<?php
include 'databaseConnect.php'; // Include database connection file
include 'databaseLogin.php'; 

// Function to insert a new product into the database
function insertProduct($name, $price, $imageURL, $description, $category, $brand) {
    global $conn;
    $stmt = $conn->prepare("CALL InsertProduct(?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssii", $name, $price, $imageURL, $description, $category, $brand);
    $stmt->execute();
    $stmt->close();
}

// Function to delete a product by name
function deleteProductByName($name) {
    global $conn;
    $stmt = $conn->prepare("CALL DeleteProductByName(?)");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->close();
}

function AddCatfunc($name, $catdetail) {
    global $conn;
    $stmt = $conn->prepare("CALL AddCat(?,?)");
    $stmt->bind_param("ss", $name,$catdetail);
    $stmt->execute();
    $stmt->close();
}

function DelteCatfunc($delete_cat) {
    global $conn;
    $stmt = $conn->prepare("CALL DeleteCatByName(?)");
    $stmt->bind_param("s", $delete_cat);
    $stmt->execute();
    $stmt->close();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if adding product form is submitted
    if (isset($_POST["add_product"])) {
        // Retrieve form data for adding a new product
        $name = $_POST["name"];
        $price = $_POST["price"];
        $imageURL = $_POST["image_url"];
        $description = $_POST["description"];
        $category = $_POST["category"];
        $brand = $_POST["brand"];

        // Insert the product into the database
        insertProduct($name, $price, $imageURL, $description, $category, $brand);
    }
    // Check if delete product form is submitted
    elseif (isset($_POST["delete_product"])) {
        $productName = $_POST["product_name"];
        deleteProductByName($productName);
    }
    elseif (isset($_POST["add_cat"])) {
        $catName = $_POST["name"];
        $catomschrijving = $_POST["omschrijving"];
        AddCatfunc($catName, $catomschrijving );
    }
    elseif (isset($_POST["delete_cat"])) {
        $delete_cat = $_POST["name"];
        DelteCatfunc($delete_cat);
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
        <div>
            <h2>Voeg een nieuw product toe</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">Naam:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="price">Prijs:</label><br>
                <input type="number" id="price" name="price" step="0.01" required><br>

                <label for="image_url">Afbeelding URL:</label><br>
                <input type="text" id="image_url" name="image_url" required><br>

                <label for="description">Omschrijving:</label><br>
                <textarea id="description" name="description" required></textarea><br>

                <label for="category">Categorie:</label><br>
                <select id="category" name="category" required>
                    <option value="1">Laptops</option>
                    <option value="2">Smartphones</option>
                    <option value="3">Smartwatches</option>
                    <option value="4">other</option>
                </select><br>

                <label for="brand">Merk:</label><br>
                <select id="brand" name="brand" required>
                    <option value="1">Samsung</option>
                    <option value="2">Iphone</option>
                </select><br>


                <button type="submit" name="add_product">add product</button>
            </form>
        <div></div>
        </section>


        <section>
        <div>
            <h2>Delete een product</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="product_name">Naam van het product dat u wilt verwijderen:</label><br>
                <input type="text" id="product_name" name="product_name" required><br>
                <button type="submit" name="delete_product">Verwijder product</button>
            </form>
        <div></div>
        </section>

        <section>
        <div>
            <h2>add een catagory</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">Naam:</label><br>
                <input type="text" id="name" name="name" required><br>

                <label for="omschrijving">omschrijving:</label><br>
                <input type="text" id="omschrijving" name="omschrijving" required><br>

                <button type="submit" name="add_cat">add cat</button>
            </form>
        <div></div>
        </section>

        <section>
        <div>
            <h2>delete een catagory</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="name">Naam:</label><br>
                <input type="text" id="name" name="name" required><br>

                <button type="submit" name="delete_cat">add cat</button>
            </form>
        <div></div>
        </section>
    </main>
    
    <footer>
        <p>&copy; 2024 Webshop.</p>
    </footer>
</body>
</html>
