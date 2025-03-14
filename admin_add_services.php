<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Sanitize inputs to prevent SQL Injection
    $service_name = mysqli_real_escape_string($conn, $service_name);
    $price = mysqli_real_escape_string($conn, $price);
    $description = mysqli_real_escape_string($conn, $description);

    // Validate inputs
    if (empty($service_name) || empty($price) || empty($description)) {
        $error_message = "All fields are required.";
    } else {
        // Insert the service into the database
        $sql = "INSERT INTO services (service_name, price, description) VALUES ('$service_name', '$price', '$description')";
        if ($conn->query($sql) === TRUE) {
            $success_message = "Service added successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Service</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .error { color: red; }
        .success { color: green; }
        form { max-width: 500px; margin: auto; }
        label { font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; margin: 5px 0 15px; }
    </style>
</head>
<body>

    <h1>Add New Service</h1>

    <?php
    if (isset($error_message)) {
        echo "<p class='error'>$error_message</p>";
    }
    if (isset($success_message)) {
        echo "<p class='success'>$success_message</p>";
    }
    ?>

    <form method="POST">
        <label for="service_name">Service Name:</label>
        <input type="text" id="service_name" name="service_name" required>

        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <button type="submit">Add Service</button>
    </form>

</body>
</html>
