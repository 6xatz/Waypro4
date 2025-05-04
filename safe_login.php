<?php
$mysqli = new mysqli("localhost", "root", "", "6xatz");

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

function sanitize_input($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

$username = sanitize_input($_POST['username'] ?? '');
$password = sanitize_input($_POST['password'] ?? '');

if (!preg_match('/^\w{3,50}$/', $username) || !preg_match('/^\w{3,50}$/', $password)) {
    die('Format username/password tidak valid.');
}

$stmt = $mysqli->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result && $result->num_rows > 0) {
    echo "Login berhasil!";
} else {
    echo "Login gagal!";
}
?>
