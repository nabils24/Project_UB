<?php
require 'functions.php'; // Include your functions file

function generateUUID()
{
    // Generate 16 random bytes
    $data = random_bytes(16);

    // Set the version to 4 (random)
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Version 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Variant 10

    // Format the bytes as a UUID
    return sprintf(
        '%s-%s-%s-%s-%s',
        bin2hex(substr($data, 0, 4)),
        bin2hex(substr($data, 4, 2)),
        bin2hex(substr($data, 6, 2)),
        bin2hex(substr($data, 8, 2)),
        bin2hex(substr($data, 10, 6))
    );
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $id = trim($_POST['add_id']);
    $username = trim($_POST['add_username']);
    $password = trim($_POST['add_password']);
    $role = trim($_POST['add_role']);

    // Validate the input
    if (empty($id) || empty($username) || empty($password) || empty($role)) {
        header('Location: listusers.php?error=empty_fields');
        exit();
    }

    // Check if id already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // id already exists
        header('Location: listusers.php?error=ID already exists');
        exit();
    }

    // Hash the password using md5
    $hashedPassword = md5($password);

    // Generate a UUID for the new user
    $uuid = generateUUID();

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO users (uuid, id, username, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("sssss", $uuid, $id, $username, $hashedPassword, $role);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the user list page with a success message
        header('Location: listusers.php?success=User added successfully');
    } else {
        // Redirect to the user list page with an error message
        header('Location: listusers.php?error=Failed to add user');
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
