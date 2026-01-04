<?php include 'includes/header.php'; ?>
<?php include 'conn.php'; ?>

<h2>Add New Product</h2>
<p>Upload a product with image (saved to data/uploads/).</p>

<form method="POST" enctype="multipart/form-data">
    <label>Product Name:</label><br>
    <input type="text" name="name" required><br><br>
    
    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="50"></textarea><br><br>
    
    <label>Image:</label><br>
    <input type="file" name="image" required><br><br>
    
    <input type="submit" value="Add Product">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    
    // Handle image upload
    $uploadDir = 'data/uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
    
    $imageName = basename($_FILES['image']['name']);
    $imagePath = $uploadDir . $imageName;
    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
        // Insert into DB (no sanitization here, as it's for labs)
        $stmt = $conn->prepare("INSERT INTO products (name, description, image_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $description, $imagePath);
        $stmt->execute();
        echo "<p>Product added successfully!</p>";
    } else {
        echo "<p>Image upload failed.</p>";
    }
}
?>

<div class="back"><a href="index.php">← Back to Home</a></div>
<?php include 'includes/footer.php'; ?>