<?php
require 'functions.php'; // Include your functions file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $category = trim($_POST['add_category']);

    // Validate the input
    if (empty($category)) {
        header('Location: listcategoryscope.php?error=empty_fields');
        exit();
    }

    // Check if id already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM category_scope WHERE id = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        // id already exists
        header('Location: listcategoryscope.php?error=ID already exists');
        exit();
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO category_scope (name_category, created_at) VALUES (?, NOW())");
    $stmt->bind_param("s", $category);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect to the user list page with a success message
        header('Location: listcategoryscope.php?success=Category  added successfully');
    } else {
        // Redirect to the user list page with an error message
        header('Location: listcategoryscope.php?error=Failed to add category');
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
