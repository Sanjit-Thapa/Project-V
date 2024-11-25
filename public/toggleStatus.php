<?php
// Start the session
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
 
    header("Location: login.php");
    exit();
}


require_once 'connection.php';


if (isset($_GET['ArtId'])) {
    $artId = $_GET['ArtId'];

    // Toggle the status of the artwork (assuming the status is a field in your database)
    $sql = "UPDATE artwork SET listed = NO listed WHERE ArtId = ?";
    
    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $artId);
        $stmt->execute();
        $stmt->close();

        // Redirect back to a page or give a success message
        header("Location: artworkList.php?status=success");
    } else {
        // Handle any errors with the query
        echo "Error updating status: " . $conn->error;
    }
} else {
    // If ArtId is not set, show an error or redirect
    echo "Error: Artwork ID is missing.";
}
?>
