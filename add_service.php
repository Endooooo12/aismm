<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $service_name = $_POST['service_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Insert the new service into the database
    $sql = "INSERT INTO services (service_name, price, description) VALUES ('$service_name', '$price', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "Service added successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Service</title>
</head>
<body>

    <h2>Add New Service</h2>

    <form method="POST">
        <label for="service_name">Service Name:</label><br>
        <input type="text" id="service_name" name="service_name" required><br><br>

        <label for="price">Price:</label><br>
        <input type="number" step="0.01" id="price" name="price" required><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description" required></textarea><br><br>

        <button type="submit">Add Service</button>
    </form>

</body>
</html>
