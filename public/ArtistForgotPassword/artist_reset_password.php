<?php 

require "../connection.php";

$token = $_POST["token"]; // Take the token from the query string
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM artistsignup_tb WHERE token_hash = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("s", $token_hash);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("Token not found");
}

// Check if the token has expired
if (strtotime($user["token_expires"]) <= time()) {
    die("Token has expired");
}

// Validate password
if (strlen($_POST['password']) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sqlUpd = "UPDATE artistsignup_tb SET ArtistPassword = ?, token_hash = NULL, token_expires = NULL WHERE Artist_Id = ?";
$stmts = $conn->prepare($sqlUpd);

if (!$stmts) {
    die("SQL Error: " . $conn->error);
}

$stmts->bind_param("si", $password_hash, $user["Artist_Id"]);
$stmts->execute();

header("Location:Password_reset_success.html");

?>