<?php
require 'functions.php'; // Ensure database connection is established

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check if the UUID is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare a statement to delete the user
        $stmt = $conn->prepare("DELETE FROM category_scope WHERE id = ?");
        $stmt->bind_param("s", $id);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect with a success message
            header('Location: listcategoryscope.php?success=category_deleted');
        } else {
            // Redirect with an error message
            header('Location: listcategoryscope.php?warning=delete_failed');
        }

        // Close the statement
        $stmt->close();
    } else {
        // Redirect with an error message if UUID is not set
        header('Location: listcategoryscope.php?warning=invalid_request');
    }
} else {
    // Redirect with an error message if the request method is not GET
    header('Location: listcategoryscope.php?error=invalid_request');
}

// Close the database connection
$conn->close();
?>