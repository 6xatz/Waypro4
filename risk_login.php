<?php
$conn = new mysqli("localhost", "root", "", "6xatz");

$username = $_POST['username'];
$password = $_POST['password'];

echo "Query: SELECT * FROM users WHERE username = '$username' AND password = '$password'<br>";
$result = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");

if ($result->num_rows > 0) {
    echo "Login berhasil!<br>";
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " | Username: " . $row["username"] . " | Password: " . $row["password"] . "<br>";
    }
} else {
    echo "Login gagal!";
}
?>
