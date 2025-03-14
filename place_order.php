<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $service_id = $_POST['service_id'];
    $quantity = $_POST['quantity'];

    // Get service price
    $service_sql = "SELECT * FROM services WHERE id = '$service_id'";
    $service_result = $conn->query($service_sql);
    $service = $service_result->fetch_assoc();

    $total = $service['price'] * $quantity;

    // Check if user has enough balance
    $user_sql = "SELECT balance FROM users WHERE id = '$user_id'";
    $user_result = $conn->query($user_sql);
    $user = $user_result->fetch_assoc();

    if ($user['balance'] >= $total) {
        // Place order
        $sql = "INSERT INTO orders (user_id, service_id, quantity, total, status) 
                VALUES ('$user_id', '$service_id', '$quantity', '$total', 'Pending')";

        if ($conn->query($sql) === TRUE) {
            // Deduct balance
            $new_balance = $user['balance'] - $total;
            $update_balance_sql = "UPDATE users SET balance = '$new_balance' WHERE id = '$user_id'";
            $conn->query($update_balance_sql);
            
            echo json_encode(['status' => 'success', 'message' => 'Order placed successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Insufficient balance.']);
    }
}
?>
