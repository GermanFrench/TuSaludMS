<?php
// Configuración de conexión a la base de datos
$host = 'localhost';
$user = 'root'; // Usuario por defecto de XAMPP
$password = ''; // Contraseña por defecto en XAMPP (si no tienes una configurada)
$dbname = 'contactos_db'; // Nombre de la base de datos que creaste

// Crear la conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir y sanitizar los datos del formulario
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO contactos (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.";
    } else {
        echo "Error al guardar los datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
