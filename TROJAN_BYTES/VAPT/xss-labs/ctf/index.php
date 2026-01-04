<!-- index.php (Home Page) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF E-Commerce - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; font-family: Arial, sans-serif; }
        .navbar { background: #343a40 !important; }
        .product-card { transition: transform 0.3s; }
        .product-card:hover { transform: scale(1.05); }
        .hero { background: #007bff; color: white; padding: 100px 0; text-align: center; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">CTF Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item">
                    <form class="d-flex" action="search.php" method="GET">
                        <input class="form-control me-2" type="search" placeholder="Search products" name="q">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="hero">
    <div class="container">
        <h1>Welcome to CTF E-Commerce</h1>
        <p>Discover amazing products at unbeatable prices!</p>
    </div>
</div>

<div class="container my-5">
    <h2 class="text-center mb-4">Featured Products</h2>
    <div class="row">
        <?php
        include 'conn.php';
        $sql = "SELECT * FROM products LIMIT 5";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="' . htmlspecialchars($row['image_path']) . '" class="card-img-top" alt="' . htmlspecialchars($row['name']) . '">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($row['name']) . '</h5>
                            <p class="card-text">' . htmlspecialchars($row['description']) . '</p>
                            <a href="#" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            echo '<p class="text-center">No products found.</p>';
        }
        $conn->close();
        ?>
    </div>
</div>

<footer class="text-center py-4 bg-dark text-light">
    <p>&copy; 2026 CTF E-Commerce. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>