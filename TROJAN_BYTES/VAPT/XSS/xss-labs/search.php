<?php
header('Content-Type: application/json');
include 'conn.php'; // your database connection file

$search = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($search === '') {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $conn->prepare("
        SELECT id, name, description, image_path 
        FROM products 
        WHERE name LIKE ? OR description LIKE ?
    ");
    $like = "%$search%";
    $stmt->bind_param("ss", $like, $like);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'name'        => $row['name'],
            'description' => $row['description'],
            'image'       => $row['image_path'] // relative path like 'data/uploads/product1.jpg'
        ];
    }

    echo json_encode($products);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}

$conn->close();
?>