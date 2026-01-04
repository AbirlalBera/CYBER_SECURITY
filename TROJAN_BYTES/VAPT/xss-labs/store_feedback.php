<?php
header('Content-Type: application/json');
include 'conn.php';

$input = json_decode(file_get_contents('php://input'), true);
if (!$input || empty(trim($input['feedback'])) || !isset($input['difficulty'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

$feedback = trim($input['feedback']);
$difficulty = $input['difficulty']; // easy, medium, or hard

$table = 'feedback_' . $difficulty;

try {
    $stmt = $conn->prepare("INSERT INTO `$table` (feedback) VALUES (?)");
    $stmt->bind_param("s", $feedback);
    $stmt->execute();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Save failed']);
}
?>