<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "richgames";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

$email = $_POST['email'];
$pass = $_POST['password'];

$sql_check_email = "SELECT * FROM registro WHERE email = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $email);
$stmt_check_email->execute();
$result = $stmt_check_email->get_result();

if ($result->num_rows > 0) {
    // El email ya existe en la base de datos
    echo "El email ya está registrado. Por favor, elige otro email.";
} else {
    
    $date = date('d-m-y h:i:s');

    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "INSERT INTO registro (email, pass, actual_date) VALUES (?, ?, NOW())";
    $stmt_insert = $conn->prepare($sql);
    $stmt_insert->bind_param("ss", $email, $hashed_password);

    if ($stmt_insert->execute()) {
        $_SESSION['success_message'] = "Usuario registrado con éxito.";
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt_insert->close();
}

$stmt_check_email->close();
$conn->close();
?>
