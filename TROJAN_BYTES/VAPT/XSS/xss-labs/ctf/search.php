<!-- Updated search.php with CTF Flag & Rate Limiting -->

<?php
include 'conn.php';

// Rate Limiting Table (Run once in DB)


// Rate Limiting Logic
$ua = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
$limit = 5; // Max requests per minute
$block_time = 300; // Block for 5 min (300 sec)
$time_window = 60; // 1 min

// Check if UA exists
$stmt = $conn->prepare("SELECT request_count, last_request, blocked_until FROM rate_limits WHERE user_agent = ?");
$stmt->bind_param("s", $ua);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && $row['blocked_until'] > date('Y-m-d H:i:s')) {
    die('<div class="alert alert-danger">Access blocked due to too many requests. Try later.</div>');
}

$current_time = time();
$last_time = $row ? strtotime($row['last_request']) : 0;

if ($current_time - $last_time < $time_window) {
    $count = ($row ? $row['request_count'] : 0) + 1;
    if ($count > $limit) {
        $blocked_until = date('Y-m-d H:i:s', $current_time + $block_time);
        $update_stmt = $conn->prepare("UPDATE rate_limits SET blocked_until = ? WHERE user_agent = ?");
        $update_stmt->bind_param("ss", $blocked_until, $ua);
        $update_stmt->execute();
        die('<div class="alert alert-danger">Access blocked due to brute force attempt. Try after 5 minutes.</div>');
    }
} else {
    $count = 1; // Reset count after time window
}

$upsert_stmt = $conn->prepare("INSERT INTO rate_limits (user_agent, request_count, last_request) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE request_count = ?, last_request = NOW(), blocked_until = NULL");
$upsert_stmt->bind_param("sii", $ua, $count, $count);
$upsert_stmt->execute();

// Normal Search Code
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CTF E-Commerce - Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .navbar { background: #343a40 !important; }
        .product-card { transition: transform 0.3s; }
        .product-card:hover { transform: scale(1.05); }
        .ctf-flag { display: none; } /* Hidden flag for XSS to exfiltrate */
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
                        <input class="form-control me-2" type="search" placeholder="Search products" name="q" value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>">
                        <button class="btn btn-outline-light" type="submit">Search</button>
                    </form>
                </li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <?php
    if (isset($_GET['q'])) {
        $query = $_GET['q'];
        // Hard XSS: Naive filter, vulnerable to case bypass, events
        $filtered = str_ireplace(['<script>', '</script>', 'alert'], ['', '', ''], $query); // Blocks basic, but bypass with <ScRiPt>, onError, etc.

        echo '<h2 class="text-center mb-4">Search Results for: <span id="searchTerm">' . htmlspecialchars($filtered, ENT_QUOTES) . '</span></h2>';
        echo '<script>document.getElementById("searchTerm").innerHTML = "' . $filtered . '";</script>'; // JS context vuln for breakout: \";alert('CTF{XSS_MASTER}');//

        // CTF Flag - Hidden for exfil
        echo '<div class="ctf-flag" id="flag" style="display:none;">CTF{XSS_MASTER}</div>';
        // Successful payload can do: \";alert(document.getElementById('flag').textContent);//

        $search = "%" . $conn->real_escape_string($query) . "%";
        $sql = "SELECT * FROM products WHERE name LIKE '$search' OR description LIKE '$search'";
        $result = $conn->query($sql);

        echo '<div class="row">';
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
            echo '<p class="text-center">No products found for "' . htmlspecialchars($query) . '".</p>';
        }
        echo '</div>';
    } else {
        echo '<h2 class="text-center mb-4">Search Results</h2>';
        echo '<p class="text-center">Please enter a search query.</p>';
    }
    $conn->close();
    ?>
</div>

<footer class="text-center py-4 bg-dark text-light">
    <p>&copy; 2026 CTF E-Commerce. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>