<?php
header('Content-Type: application/json');
include 'conn.php';

$difficulty = $_GET['difficulty'] ?? 'medium';
$table = 'feedback_' . $difficulty;

try {
    $stmt = $conn->prepare("SELECT feedback FROM `$table` ORDER BY id DESC LIMIT 15");
    $stmt->execute();
    $result = $stmt->get_result();

    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = ['feedback' => $row['feedback']];
    }
    // Reverse to show oldest first
    echo json_encode(array_reverse($items));
} catch (Exception $e) {
    echo json_encode([]);
}
?>