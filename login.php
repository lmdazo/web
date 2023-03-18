<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "richgames";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM registro WHERE email = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($pass, $row['pass'])) {
        $_SESSION['email'] = $email;
        $sql = "INSERT INTO usuarios (email) VALUES (?)";
        
        $stmt_insert = $conn->prepare($sql);
        $stmt_insert->bind_param("s", $email);
        
        if ($stmt_insert->execute()) {
            header("Location: index.php?email=" . urlencode($email));
            exit;
        } else {
            echo "Error al insertar el email: " . $stmt_insert->error;
        }
        
        $stmt_insert->close();
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "El email no está registrado.";
}


$stmt->close();
$conn->close();
?>
