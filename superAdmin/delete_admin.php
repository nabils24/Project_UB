<?php
require 'functions.php'; // Ensure database connection is established

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the UUID is set in the URL
    if (isset($_GET['uuid'])) {
        $uuid = $_GET['uuid'];

        // Prepare a statement to delete the user
        $stmt = $conn->prepare("DELETE FROM users WHERE uuid = ?");
        $stmt->bind_param("s", $uuid);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect with a success message
            header('Location: listadmin.php?success=admin_deleted');
        } else {
            // Redirect with an error message
            header('Location: listadmin.php?warning=delete_failed');
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect with an error message if UUID is not set
        header('Location: listadmin.php?warning=invalid_request');
    }
} else {
    // Redirect with an error message if the request method is not GET
    header('Location: listadmin.php?error=invalid_request');
}

// Close the database connection
$conn->close();
?>